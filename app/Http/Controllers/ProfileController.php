<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the profile terminal (student dashboard).
     */
    public function index()
    {
        $user = Auth::user();
        $stats = [];

        if ($user->role === 'student') {
            // Student Stats
            $enrollments = $user->enrollments()->with('course.sections.lessons')->get();
            $enrollmentsCount = $enrollments->count();

            $completedCount = 0;
            foreach ($enrollments as $enrollment) {
                $course = $enrollment->course;
                if (!$course) continue;

                $lessonIds = $course->sections->flatMap->lessons->pluck('id');
                $totalLessons = $lessonIds->count();

                if ($totalLessons > 0) {
                    $completedLessonsCount = \App\Models\LessonProgress::query()->where('user_id', '=', $user->id)
                        ->whereIn('lesson_id', $lessonIds)
                        ->where('is_completed', '=', true)
                        ->count();

                    if ($completedLessonsCount === $totalLessons) {
                        $completedCount++;
                    }
                }
            }
            $stats = [
                ['label' => 'Kursus Diambil', 'value' => str_pad($enrollmentsCount, 2, '0', STR_PAD_LEFT), 'icon' => 'fa-graduation-cap', 'color' => 'var(--accent-primary)'],
                ['label' => 'Kursus Selesai', 'value' => str_pad($completedCount, 2, '0', STR_PAD_LEFT), 'icon' => 'fa-circle-check', 'color' => '#eab308']
            ];
        } elseif ($user->role === 'instructor') {
            // Instructor Stats
            $totalCourses = \App\Models\Course::where('user_id', $user->id)->count();
            $totalStudents = \App\Models\Enrollment::whereHas('course', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->distinct('user_id')->count();
            
            $stats = [
                ['label' => 'Total Kursus', 'value' => str_pad($totalCourses, 2, '0', STR_PAD_LEFT), 'icon' => 'fa-book', 'color' => 'var(--accent-primary)'],
                ['label' => 'Total Siswa', 'value' => str_pad($totalStudents, 2, '0', STR_PAD_LEFT), 'icon' => 'fa-users', 'color' => '#10b981']
            ];
        } elseif ($user->role === 'admin') {
            // Admin Stats
            $totalUsers = \App\Models\User::count();
            $totalCourses = \App\Models\Course::count();
            
            $stats = [
                ['label' => 'Total Pengguna', 'value' => str_pad($totalUsers, 2, '0', STR_PAD_LEFT), 'icon' => 'fa-users-gear', 'color' => 'var(--accent-primary)'],
                ['label' => 'Total Kursus', 'value' => str_pad($totalCourses, 2, '0', STR_PAD_LEFT), 'icon' => 'fa-boxes-stacked', 'color' => '#6366f1']
            ];
        }

        return view('profile', compact('user', 'stats'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Verify current password if user wants to change it
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Current password verification failed. Security breach prevented.');
            }
            // Update password
            $user->password = Hash::make($request->new_password);
        }

        // Update profile details
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $user->save();

        return back()->with('success', 'Profile identity updated successfully.');
    }
}
