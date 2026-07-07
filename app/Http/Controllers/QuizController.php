<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use App\Models\LessonProgress;

class QuizController extends Controller
{
    public function submitQuiz(Request $request, Lesson $lesson)
    {
        $questions = $lesson->quizQuestions;

        if ($questions->isEmpty()) {
            return back()->with('error', 'Tidak ada kuis yang tersedia untuk materi ini.');
        }

        $score = 0;
        $total = $questions->count();
        $answers = $request->input('answers', []);

        foreach ($questions as $question) {
            if (isset($answers[$question->id]) && $answers[$question->id] === $question->correct_option) {
                $score++;
            }
        }

        $percentage = ($score / $total) * 100;

        $message = "Anda mendapatkan skor $score dari $total (" . number_format($percentage, 0) . "%).";

        // Mark as completed if they got 100% (or some threshold)
        if (Auth::check()) {
            \App\Models\QuizResult::updateOrCreate(
                ['user_id' => Auth::id(), 'lesson_id' => $lesson->id],
                [
                    'score' => $score,
                    'total_questions' => $total,
                    'percentage' => $percentage,
                    'answers_data' => $answers,
                    'is_force_submitted' => $request->input('is_force_submitted', 0) == 1
                ]
            );

            $passingScore = $lesson->quiz_passing_score ?? 0;
            if ($score >= $passingScore) {
                $progress = LessonProgress::firstOrCreate(
                    ['user_id' => Auth::id(), 'lesson_id' => $lesson->id]
                );
                if (!$progress->is_completed) {
                    $progress->is_completed = true;
                    $progress->save();
                    $message .= " Materi ditandai sebagai selesai!";
                }
            }
        }

        return back()->with('quiz_result', [
            'score' => $score,
            'total' => $total,
            'percentage' => $percentage,
            'message' => $message
        ]);
    }
}
