<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Withdrawal;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function checkRole()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Aksi tidak diizinkan. Akses Admin diperlukan.');
        }
    }

    public function withdrawals()
    {
        $this->checkRole();
        // Load withdrawals with the instructor info, sorted by pending first then date
        $withdrawals = Withdrawal::with('user')
            ->orderByRaw("CASE WHEN status = 'pending' THEN 1 WHEN status = 'failed' THEN 2 ELSE 3 END")
            ->latest()
            ->paginate(15);

        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    public function updateWithdrawal(Request $request, Withdrawal $withdrawal)
    {
        $this->checkRole();

        $request->validate(['status' => 'required|in:completed,failed']);

        $withdrawal->update(['status' => $request->status]);

        $msg = 'Status penarikan diperbarui.';
        if ($request->status === 'completed') {
            $msg = 'DANA TERKIRIM: Transfer buku kas ditandai sebagai dikonfirmasi dan selesai.';
        } elseif ($request->status === 'failed') {
            $msg = 'TRANSFER DIBATALKAN: Permintaan penarikan ditolak dan ditandai sebagai gagal.';
        }

        return back()->with('success', $msg);
    }

    public function destroyWithdrawal(Withdrawal $withdrawal)
    {
        $this->checkRole();
        Withdrawal::destroy($withdrawal->id);
        return back()->with('success', 'REKOR DIHAPUS: Riwayat penarikan telah dihapus dari buku kas.');
    }

    public function editUser(User $user)
    {
        $this->checkRole();
        return response()->json($user);
    }

    public function updateUser(Request $request, User $user)
    {
        $this->checkRole();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);
        return back()->with('success', 'IDENTITAS DIUBAH: Data pengguna telah diperbarui dalam direktori utama.');
    }

    public function dashboard()
    {
        $this->checkRole();

        $totalUsers = User::query()->count('*');
        $totalInstructors = User::query()->where('role', '=', 'instructor')->count('*');
        $totalStudents = User::query()->where('role', '=', 'student')->count('*');
        $totalCourses = Course::query()->count('*');
        $pendingPayments = Enrollment::where('status', 'pending')->count();

        // System Wide Revenue Calculation (Total Sales - Completed Payouts)
        $grossRevenue = Enrollment::sum('price_paid');
        $totalPaidOut = Withdrawal::query()->where('status', '=', 'completed')->sum('amount');
        $totalRevenue = $grossRevenue - $totalPaidOut;

        $recentUsers = User::query()->latest('created_at')->take(5)->get();
        $recentCourses = Course::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalInstructors',
            'totalStudents',
            'totalCourses',
            'totalRevenue',
            'pendingPayments',
            'recentUsers',
            'recentCourses'
        ));
    }

    // --- User Management ---

    public function users()
    {
        $this->checkRole();
        $users = User::query()->latest('created_at')->paginate(15);

        // Include counts for display
        foreach ($users as $user) {
            if ($user->role === 'instructor') {
                $user->metrics = Course::query()->where('user_id', '=', $user->id)->count('*') . ' Kursus';
            } else {
                $user->metrics = Enrollment::query()->where('user_id', '=', $user->id)->count('*') . ' Pendaftaran';
            }
        }

        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $this->checkRole();

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat mengubah peran Anda sendiri.');
        }

        $request->validate(['role' => 'required|in:admin,instructor,student']);

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Peran pengguna berhasil diperbarui.');
    }

    public function destroyUser(User $user)
    {
        $this->checkRole();

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus diri sendiri.');
        }

        User::destroy($user->id);
        return back()->with('success', 'Pengguna berhasil dihapus.');
    }

    public function purgeLedger(User $user)
    {
        $this->checkRole();

        if ($user->role !== 'instructor') {
            return back()->with('error', 'Pengguna target bukan seorang instruktur.');
        }

        // Get all course IDs owned by this instructor
        $courseIds = Course::query()->where('user_id', '=', $user->id)->pluck('id');

        // Delete all enrollments associated with these courses
        // This effectively resets the ledger/earnings
        \Illuminate\Support\Facades\DB::table('enrollments')
            ->whereIn('course_id', $courseIds->all())
            ->delete();

        return back()->with('success', "Buku kas keuangan untuk {$user->name} telah berhasil dihapus. Semua data transaksi telah dihilangkan.");
    }

    public function purgeGlobalLedger()
    {
        $this->checkRole();

        // Wipe ALL transaction records
        Enrollment::truncate();

        return back()->with('success', "KRITIS: Buku kas keuangan global telah dikosongkan sepenuhnya. Semua log transaksi dan akses siswa telah diatur ulang.");
    }

    // --- Course Management ---

    public function courses()
    {
        $this->checkRole();

        // Retrieve courses with their author and enrollments count
        $courses = Course::with('user')->withCount('enrollments')->latest()->paginate(15);

        return view('admin.courses', compact('courses'));
    }

    public function verificationQueue()
    {
        $this->checkRole();
        $courses = Course::with('user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);

        return view('admin.verification.index', compact('courses'));
    }

    public function updateCourseStatus(Request $request, Course $course)
    {
        $this->checkRole();

        $request->validate(['status' => 'required|in:draft,published,pending,rejected']);
        $course->update(['status' => $request->status]);

        $message = 'Status kursus berhasil diperbarui.';
        if ($request->status === 'published') {
            $message = 'Kursus telah diverifikasi dan diterbitkan ke repositori.';
        } elseif ($request->status === 'rejected') {
            $message = 'Kursus telah ditolak dan dikembalikan ke penulis.';
        }

        return back()->with('success', $message);
    }

    public function destroyCourse(Course $course)
    {
        $this->checkRole();

        Course::destroy($course->id);
        return back()->with('success', 'Kursus dihapus oleh admin.');
    }

    public function payments()
    {
        $this->checkRole();
        $enrollments = Enrollment::with(['user', 'course'])
            ->orderByRaw("CASE WHEN status = 'pending' THEN 1 ELSE 2 END")
            ->latest()
            ->paginate(15);

        return view('admin.payments.index', compact('enrollments'));
    }

    public function verifyPayment(Request $request, Enrollment $enrollment)
    {
        $this->checkRole();
        $request->validate(['status' => 'required|in:active,cancelled']);

        $updateData = ['status' => $request->status];
        if ($request->status === 'active') {
            $updateData['paid_at'] = now();
        }

        $enrollment->update($updateData);

        $msg = $request->status === 'active' ? 'Pembayaran dikonfirmasi! Akses kursus telah diberikan.' : 'Pembayaran dibatalkan/ditolak.';
        return back()->with('success', $msg);
    }

    public function destroyEnrollment(Enrollment $enrollment)
    {
        $this->checkRole();
        $enrollment->delete();
        return back()->with('success', 'Rekor pendaftaran dihapus.');
    }

    // --- Category Management ---

    public function categories()
    {
        $this->checkRole();

        $categories = \App\Models\Category::withCount('courses')->latest()->paginate(15);
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $this->checkRole();

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        \App\Models\Category::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name)
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    public function destroyCategory(\App\Models\Category $category)
    {
        $this->checkRole();

        if ($category->courses()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus kategori yang memiliki kursus di dalamnya.');
        }

        \App\Models\Category::destroy($category->id);
        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    // --- Certificate Management ---

    public function certificates(Request $request)
    {
        $this->checkRole();

        $query = Certificate::with(['user', 'course'])->latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('certificate_code', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('course', function($q) use ($search) {
                      $q->where('title', 'LIKE', "%{$search}%");
                  });
        }

        $certificates = $query->paginate(15);
        return view('admin.certificates', compact('certificates'));
    }

    public function finance()
    {
        $this->checkRole();

        $enrollments = Enrollment::with(['user', 'course'])->latest()->take(50)->get();
        $withdrawals = Withdrawal::with('user')->latest()->take(50)->get();

        $merged = collect();

        foreach ($enrollments as $e) {
            $merged->push((object)[
                'date' => $e->created_at,
                'type' => 'income',
                'description' => "Penjualan: " . ($e->course->title ?? 'N/A'),
                'user' => $e->user->name ?? 'N/A',
                'amount' => $e->price_paid,
                'status' => $e->status
            ]);
        }

        foreach ($withdrawals as $w) {
            $merged->push((object)[
                'date' => $w->created_at,
                'type' => 'expense',
                'description' => "Penarikan Dana (Instruktur)",
                'user' => $w->user->name ?? 'N/A',
                'amount' => $w->amount,
                'status' => $w->status
            ]);
        }

        $history = $merged->sortByDesc('date');

        $grossRevenue = Enrollment::sum('price_paid');
        $totalPaidOut = Withdrawal::query()->where('status', '=', 'completed')->sum('amount');
        $pendingPayouts = Withdrawal::query()->where('status', '=', 'pending')->sum('amount');

        return view('admin.finance', compact('history', 'grossRevenue', 'totalPaidOut', 'pendingPayouts'));
    }
}
