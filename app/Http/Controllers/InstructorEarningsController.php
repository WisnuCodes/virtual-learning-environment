<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Withdrawal;

class InstructorEarningsController extends Controller
{
    private function checkRole()
    {
        if (Auth::user()->role !== 'instructor') {
            abort(403, 'Aksi tidak diizinkan. Akses Instruktur diperlukan.');
        }
    }

    public function index()
    {
        $this->checkRole();
        $user = Auth::user();

        // Get all courses owned by this instructor
        $courses = Course::where('user_id', $user->id)->pluck('id');

        // Total number of enrollments across all their courses
        $totalEnrollments = Enrollment::whereIn('course_id', $courses)->count();

        // Let's get enrollment details mimicking transactions
        $transactions = Enrollment::whereIn('course_id', $courses)
            ->with(['user', 'course'])
            ->latest()
            ->paginate(15);

        // Calculate Revenue (Basic: Course Price * Enrollments)
        $totalRevenue = 0;
        $thisMonthRevenue = 0;

        $allEnrollments = Enrollment::whereIn('course_id', $courses)->with('course')->get();

        foreach ($allEnrollments as $enrollment) {
            $price = $enrollment->price_paid;
            $totalRevenue += $price;

            if ($enrollment->created_at->isCurrentMonth()) {
                $thisMonthRevenue += $price;
            }
        }

        // Platform fee assumption (e.g. 30%)
        $platformFeeRate = 0.10;

        $thisMonthGross = $thisMonthRevenue * (1 - $platformFeeRate);
        $thisMonthWithdrawn = Withdrawal::where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $thisMonthNetRevenue = $thisMonthGross - $thisMonthWithdrawn;
        if ($thisMonthNetRevenue < 0) $thisMonthNetRevenue = 0;

        $netEarnings = $totalRevenue * (1 - $platformFeeRate);

        // Calculate the amount already withdrawn or pending by this user
        $totalWithdrawn = Withdrawal::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'completed'])
            ->sum('amount');

        // Final available payout
        $availablePayout = $netEarnings - $totalWithdrawn;
        if ($availablePayout < 0) {
            $availablePayout = 0;
        }

        // Fetch recent withdrawal history for this instructor
        $withdrawals = Withdrawal::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        return view('instructor.earnings.index', compact(
            'transactions',
            'totalRevenue',
            'thisMonthRevenue', // This will now represent net monthly after payouts
            'netEarnings',
            'availablePayout',
            'totalEnrollments',
            'withdrawals'
        ))->with('thisMonthRevenue', $thisMonthNetRevenue);
    }

    public function requestPayout(Request $request)
    {
        $this->checkRole();
        $user = Auth::user();

        // Recalculate earnings
        $courses = Course::where('user_id', $user->id)->pluck('id');
        $allEnrollments = Enrollment::whereIn('course_id', $courses)->get();
        $totalRevenue = 0;

        foreach ($allEnrollments as $enrollment) {
            $totalRevenue += $enrollment->price_paid;
        }

        $netEarnings = $totalRevenue * (1 - 0.10);
        $totalWithdrawn = Withdrawal::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'completed'])
            ->sum('amount');
        $availablePayout = $netEarnings - $totalWithdrawn;

        // Use custom amount if provided, otherwise fail
        $requestAmount = $request->input('amount');

        if (!$requestAmount || $requestAmount <= 0) {
            return back()->with('error', 'JUMLAH TIDAK VALID: Permintaan harus menyertakan jumlah penarikan yang valid.');
        }

        if ($requestAmount > $availablePayout) {
            return back()->with('error', 'SALDO TIDAK CUKUP: Jumlah yang diminta melebihi saldo tersedia.');
        }

        // Log the withdrawal
        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $requestAmount,
            'status' => 'pending',
        ]);

        return back()->with('success', 'TRANSFER DIINISIASI: Permintaan pembayaran sebesar Rp ' . number_format($requestAmount, 0, ',', '.') . ' telah masuk antrean. Proses pencairan dana sedang berlangsung (Estimasi 3-5 hari).');
    }
}
