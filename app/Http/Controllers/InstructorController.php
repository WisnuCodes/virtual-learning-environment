<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Enrollment;

class InstructorController extends Controller
{
    public function becomeInstructor()
    {
        $user = Auth::user();
        if ($user->role !== 'instructor') {
            $user->role = 'instructor';
            $user->save();
        }
        return redirect()->route('instructor.dashboard')->with('success', 'Anda sekarang adalah seorang instruktur!');
    }

    public function dashboard()
    {
        $user = Auth::user();
        if ($user->role !== 'instructor') {
            return redirect('/');
        }

        $courses = Course::withCount('enrollments')
            ->where('user_id', $user->id)
            ->get();

        $totalStudents = $courses->sum('enrollments_count');

        $totalRevenue = Enrollment::whereIn('course_id', $courses->pluck('id'))
            ->sum('price_paid');

        return view('instructor.dashboard', compact('courses', 'totalStudents', 'totalRevenue'));
    }

    public function reviews()
    {
        $user = Auth::user();
        if ($user->role !== 'instructor') {
            return redirect('/');
        }

        $courseIds = Course::where('user_id', $user->id)->pluck('id');
        $reviews = \App\Models\Review::with(['user', 'course'])
            ->whereIn('course_id', $courseIds)
            ->latest()
            ->paginate(10);

        return view('instructor.reviews', compact('reviews'));
    }
}
