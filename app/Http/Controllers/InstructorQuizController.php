<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorQuizController extends Controller
{
    public function index(Course $course, Lesson $lesson)
    {
        // Ensure the instructor owns this course
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        $quizQuestions = $lesson->quizQuestions;

        return view('instructor.courses.quiz', compact('course', 'lesson', 'quizQuestions'));
    }

    public function store(Request $request, Course $course, Lesson $lesson)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D',
        ]);

        $isFirstQuestion = $lesson->quizQuestions()->count() === 0;

        $lesson->quizQuestions()->create([
            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'correct_option' => $request->correct_option,
        ]);

        // Notify Enrolled Students if this is the first question (quiz just became active)
        if ($isFirstQuestion) {
            $students = $course->enrollments()->with('user')->get()->pluck('user');
            foreach ($students as $student) {
                if ($student) {
                    $student->notify(new \App\Notifications\LmsNotification([
                        'title' => 'Kuis Baru Tersedia!',
                        'message' => "Kuis baru telah ditambahkan pada materi \"{$lesson->title}\" di kursus \"{$course->title}\".",
                        'link' => route('courses.watch', [$course->slug, $lesson->id]),
                        'icon' => 'fa-solid fa-lightbulb'
                    ]));
                }
            }
        }

        // Automatically Reset Quiz Results for all students so they see the new version
        \App\Models\QuizResult::where('lesson_id', $lesson->id)->delete();

        return back()->with('success', 'Pertanyaan kuis berhasil ditambahkan! Semua percobaan siswa sebelumnya untuk kuis ini telah diatur ulang agar sesuai dengan konten baru.');
    }

    public function destroy(Course $course, Lesson $lesson, QuizQuestion $quizQuestion)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        $quizQuestion->delete();

        // Automatically Reset Quiz Results for all students so they see the new version
        \App\Models\QuizResult::where('lesson_id', $lesson->id)->delete();

        return back()->with('success', 'Pertanyaan berhasil dihapus. Semua percobaan siswa sebelumnya untuk kuis ini telah diatur ulang.');
    }

    public function results(Course $course, Lesson $lesson)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        $results = \App\Models\QuizResult::with('user')
            ->where('lesson_id', $lesson->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $quizQuestions = $lesson->quizQuestions;

        return view('instructor.courses.quiz_results', compact('course', 'lesson', 'results', 'quizQuestions'));
    }
    public function updateDuration(Request $request, Course $course, Lesson $lesson)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quiz_duration' => 'required|integer|min:1',
            'quiz_max_warnings' => 'required|integer|min:1|max:10',
            'quiz_passing_score' => 'required|integer|min:0',
        ]);

        $lesson->update([
            'quiz_duration' => $request->quiz_duration,
            'quiz_max_warnings' => $request->quiz_max_warnings,
            'quiz_passing_score' => $request->quiz_passing_score,
        ]);

        return back()->with('success', 'Pengaturan kuis berhasil diperbarui!');
    }
    public function resetResult(Course $course, Lesson $lesson, \App\Models\QuizResult $quizResult)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        // Ensure the result actually belongs to this lesson
        if ($quizResult->lesson_id !== $lesson->id) {
            abort(404);
        }

        $quizResult->delete();

        return back()->with('success', 'Hasil kuis siswa telah diatur ulang. Mereka sekarang dapat mengambil kembali kuis tersebut.');
    }
}
