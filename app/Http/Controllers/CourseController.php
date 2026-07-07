<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\LessonProgress;
use App\Models\QuizResult;
use App\Models\AssignmentSubmission;
use App\Models\Category;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with('user', 'category')->where('status', 'published');

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $courses = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('courses.index', compact('courses', 'categories'));
    }

    public function show($slug)
    {
        $course = Course::with(['user', 'category', 'sections.lessons'])->where('slug', $slug)->firstOrFail();

        // Protect draft courses from public view
        if ($course->status !== 'published') {
            if (
                !\Illuminate\Support\Facades\Auth::check() ||
                (\Illuminate\Support\Facades\Auth::user()->role === 'student' &&
                    !$course->enrollments()->where('user_id', \Illuminate\Support\Facades\Auth::id())->where('status', 'active')->exists())
            ) {
                abort(404, 'Kursus tidak ditemukan atau sedang dalam status draf.');
            }
        }

        return view('courses.show', compact('course'));
    }

    public function watch($slug, $lessonId)
    {
        $course = Course::with(['sections.lessons'])->where('slug', $slug)->firstOrFail();
        /** @var \App\Models\User|null $user */
        $user = \Illuminate\Support\Facades\Auth::user();

        // 🛡️ ADMIN & OWNER BYPASS
        $isAdmin = $user && $user->role === 'admin';
        $isOwner = $user && $user->id === $course->user_id;

        // Protect draft/pending courses for regular users
        if ($course->status !== 'published' && !$isAdmin && !$isOwner) {
            if (!$user || ($user->role === 'student' && !$course->enrollments()->where('user_id', $user->id)->where('status', 'active')->exists())) {
                abort(404, 'Akses Ditolak: Aset sedang dalam audit kualitas atau status draf.');
            }
        }

        $lesson = Lesson::findOrFail($lessonId);

        // 🔒 ENROLLMENT ENFORCEMENT
        // If not free preview, verify access for non-admin/non-owner
        if (!$lesson->is_free_preview && !$isAdmin && !$isOwner) {
            if (!$user || ! $course->enrollments()->where('user_id', $user->id)->where('status', 'active')->exists()) {
                return redirect()->route('courses.show', $course->slug)
                    ->withErrors(['AUTENTIKASI_DIPERLUKAN: Anda harus mendaftar untuk mengakses materi aman ini.']);
            }
        }

        // Fetch Questions for this specific lesson
        $questions = \App\Models\Question::with(['user', 'replies.user'])
            ->where('lesson_id', $lesson->id)
            ->latest()
            ->get();

        $quizQuestions = $lesson->quizQuestions;

        $quizResult = null;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $quizResult = \App\Models\QuizResult::where('lesson_id', $lesson->id)
                ->where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->first();
        }

        $assignments = $lesson->assignments()->with(['submissions' => function ($q) {
            $q->where('user_id', \Illuminate\Support\Facades\Auth::id());
        }])->get();

        return view('courses.watch', compact('course', 'lesson', 'questions', 'quizQuestions', 'assignments', 'quizResult'));
    }

    public function enroll(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);
        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();

        // Check if already enrolled
        if (!$course->enrollments()->where('user_id', $user->id)->where('status', 'active')->exists()) {
            Enrollment::create([
                'course_id' => $course->id,
                'user_id' => $user->id,
                'price_paid' => 0,
                'status' => 'active',
                'payment_method' => 'free',
                'paid_at' => now()
            ]);
        }

        return redirect()->route('my-learning')->with('success', 'Berhasil mendaftar di ' . $course->title);
    }

    public function myLearning()
    {
        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();
        $enrollments = Enrollment::with(['course.sections.lessons'])->where('user_id', $user->id)->get();

        return view('courses.my-learning', compact('enrollments'));
    }

    public function terminateEnrollment(Enrollment $enrollment)
    {
        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();

        // Security check: only the owner can terminate
        if ($enrollment->user_id !== $user->id) {
            abort(403, 'TIDAK BERWENANG: Akses ke operasi ini dibatasi.');
        }

        $course = $enrollment->course;

        // 1. Get all lessons in the course
        $lessonIds = $course->sections()->with('lessons')->get()
            ->flatMap(function ($section) {
                return $section->lessons->pluck('id');
            });

        // 2. Terminate Progress & Data
        LessonProgress::where('user_id', $user->id)->whereIn('lesson_id', $lessonIds)->delete();
        QuizResult::where('user_id', $user->id)->whereIn('lesson_id', $lessonIds)->delete();

        // 3. Assignment Submissions
        $assignmentIds = \App\Models\Assignment::whereIn('lesson_id', $lessonIds)->pluck('id');
        AssignmentSubmission::where('user_id', $user->id)->whereIn('assignment_id', $assignmentIds)->delete();

        // 4. Finally, delete the enrollment
        $enrollment->delete();

        return redirect()->route('my-learning')->with('success', "PENGHAPUSAN SELESAI: Akses ke '{$course->title}' dan semua data terkait telah dihapus.");
    }

    public function markCompleted(Request $request, $lessonId)
    {
        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();
        $lesson = Lesson::findOrFail($lessonId);

        $progress = \App\Models\LessonProgress::firstOrCreate(
            ['user_id' => $user->id, 'lesson_id' => $lesson->id]
        );

        if (!$progress->is_completed) {
            $progress->is_completed = true;
            $progress->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Sudah selesai']);
    }
}
