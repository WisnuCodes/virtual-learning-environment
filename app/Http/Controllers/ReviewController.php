<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();

        $isEnrolled = $course->enrollments()->where('user_id', $userId)->exists();

        if (!$isEnrolled) {
            return back()->with('error', 'Anda harus terdaftar di kursus ini untuk memberikan ulasan.');
        }

        Review::updateOrCreate(
            ['user_id' => $userId, 'course_id' => $course->id],
            ['rating' => $request->rating, 'comment' => $request->comment]
        );

        return back()->with('success', 'Ulasan Anda berhasil disimpan.');
    }

    public function reply(Request $request, Review $review)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $instructorId = Auth::id();

        if ($review->course->user_id !== $instructorId) {
            abort(403, 'Anda tidak memiliki akses untuk membalas ulasan ini.');
        }

        $review->update([
            'instructor_reply' => $request->reply,
            'replied_at' => now(),
        ]);

        return back()->with('success', 'Balasan Anda berhasil dikirim.');
    }

    public function destroy(Review $review)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role;

        // Admin can delete any review
        // Instructor can delete if the review belongs to their course
        if ($userRole !== 'admin' && ($userRole !== 'instructor' || $review->course->user_id !== $userId)) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus ulasan ini.');
        }

        $review->delete();

        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
