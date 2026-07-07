<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Section;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorCurriculumController extends Controller
{
    private function checkRole()
    {
        if (Auth::user()->role !== 'instructor') {
            abort(403, 'Aksi tidak diizinkan.');
        }
    }

    private function verifyOwnership(Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403, 'Aksi tidak diizinkan.');
        }
    }

    public function index(Course $course)
    {
        $this->checkRole();
        $this->verifyOwnership($course);

        $course->load(['sections.lessons' => function ($q) {
            $q->orderBy('order_index');
        }, 'sections' => function ($q) {
            $q->orderBy('order_index');
        }]);

        return view('instructor.courses.curriculum', compact('course'));
    }

    // --- Sections ---

    public function storeSection(Request $request, Course $course)
    {
        $this->checkRole();
        $this->verifyOwnership($course);

        $request->validate(['title' => 'required|string|max:255']);

        $nextOrder = $course->sections()->max('order_index') + 1;

        $course->sections()->create([
            'title' => $request->title,
            'order_index' => $nextOrder
        ]);

        return back()->with('success', 'Bagian berhasil ditambahkan!');
    }

    public function updateSection(Request $request, Course $course, Section $section)
    {
        $this->checkRole();
        $this->verifyOwnership($course);
        if ($section->course_id !== $course->id) abort(404);

        $request->validate(['title' => 'required|string|max:255']);
        $section->update(['title' => $request->title]);

        return back()->with('success', 'Bagian berhasil diperbarui!');
    }

    public function destroySection(Course $course, Section $section)
    {
        $this->checkRole();
        $this->verifyOwnership($course);
        if ($section->course_id !== $course->id) abort(404);

        $section->delete();
        return back()->with('success', 'Bagian berhasil dihapus!');
    }


    // --- Lessons ---

    public function createLesson(Course $course, Section $section)
    {
        $this->checkRole();
        $this->verifyOwnership($course);
        if ($section->course_id !== $course->id) abort(404);

        return view('instructor.lessons.create', compact('course', 'section'));
    }

    public function storeLesson(Request $request, Course $course, Section $section)
    {
        $this->checkRole();
        $this->verifyOwnership($course);
        if ($section->course_id !== $course->id) abort(404);

        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|string|max:255',
            'video_file' => 'nullable|mimes:mp4,mov,ogg,webm,avi|max:204800',
            'content' => 'nullable|string',
            'is_free_preview' => 'nullable|boolean'
        ]);

        $finalUrl = $request->video_url;
        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('lessons', 'public');
            $finalUrl = '/storage/' . $path;
        }

        $nextOrder = $section->lessons()->max('order_index') + 1;

        $newLesson = $section->lessons()->create([
            'title' => $request->title,
            'video_url' => $finalUrl,
            'content' => $request->content,
            'is_free_preview' => $request->has('is_free_preview'),
            'order_index' => $nextOrder
        ]);

        // Notify Enrolled Students
        $students = $course->enrollments()->with('user')->get()->pluck('user');
        foreach ($students as $student) {
            if ($student) {
                $student->notify(new \App\Notifications\LmsNotification([
                    'title' => 'Materi Baru Tersedia!',
                    'message' => "Instructor telah menambahkan materi baru: \"{$request->title}\" pada kursus \"{$course->title}\".",
                    'link' => route('courses.watch', [$course->slug, $newLesson->id]),
                    'icon' => 'fa-solid fa-play-circle'
                ]));
            }
        }

        return redirect()->route('instructor.curriculum.index', $course->id)->with('success', 'Materi berhasil ditambahkan ke bagian!');
    }

    public function updateLesson(Request $request, Course $course, Section $section, Lesson $lesson)
    {
        $this->checkRole();
        $this->verifyOwnership($course);
        if ($section->course_id !== $course->id || $lesson->section_id !== $section->id) abort(404);

        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|string|max:255',
            'video_file' => 'nullable|mimes:mp4,mov,ogg,webm,avi|max:204800',
            'content' => 'nullable|string',
            'is_free_preview' => 'nullable|boolean'
        ]);

        $finalUrl = $request->video_url;
        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('lessons', 'public');
            $finalUrl = '/storage/' . $path;
        }

        $lesson->update([
            'title' => $request->title,
            'video_url' => $finalUrl,
            'content' => $request->content,
            'is_free_preview' => $request->has('is_free_preview')
        ]);

        return back()->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroyLesson(Course $course, Section $section, Lesson $lesson)
    {
        $this->checkRole();
        $this->verifyOwnership($course);
        if ($section->course_id !== $course->id || $lesson->section_id !== $section->id) abort(404);

        $lesson->delete();
        return back()->with('success', 'Materi berhasil dihapus!');
    }
}
