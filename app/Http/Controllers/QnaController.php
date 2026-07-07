<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class QnaController extends Controller
{
    public function storeQuestion(Request $request, $courseId, $lessonId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        Question::create([
            'user_id' => Auth::id(),
            'course_id' => $courseId,
            'lesson_id' => $lessonId,
            'title' => $request->title,
            'body' => $request->body,
            'is_resolved' => false
        ]);

        return back()->with('success', 'Your question has been posted successfully!');
    }

    public function storeReply(Request $request, $questionId)
    {
        $request->validate([
            'body' => 'required|string'
        ]);

        $question = Question::findOrFail($questionId);

        $isInstructor = Auth::user()->role === 'instructor' && $question->course->user_id === Auth::id();

        Reply::create([
            'user_id' => Auth::id(),
            'question_id' => $question->id,
            'body' => $request->body,
            'is_instructor_reply' => $isInstructor
        ]);

        return back()->with('success', 'Your reply has been posted!');
    }

    public function resolveQuestion(Request $request, $questionId)
    {
        $question = Question::findOrFail($questionId);

        // Only question owner or course instructor can resolve
        if (Auth::id() !== $question->user_id && !(Auth::user()->role === 'instructor' && $question->course->user_id === Auth::id())) {
            abort(403, 'Unauthorized action.');
        }

        $question->is_resolved = !$question->is_resolved;
        $question->save();

        return back()->with('success', 'Question status updated.');
    }

    public function destroyQuestion(Question $question)
    {
        // Only owner or course instructor can delete
        if (Auth::id() !== $question->user_id && !(Auth::user()->role === 'instructor' && $question->course->user_id === Auth::id())) {
            abort(403, 'Unauthorized action.');
        }

        // Replies will be deleted by cascade if DB is set up, 
        // but let's be explicit if needed or just delete the question.
        $question->delete();

        return back()->with('success', 'TOPIC PURGED: The discussion thread has been removed from the lesson telemetry.');
    }
}
