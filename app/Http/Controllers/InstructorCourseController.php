<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InstructorCourseController extends Controller
{
    private function checkRole()
    {
        if (Auth::user()->role !== 'instructor') {
            abort(403, 'Aksi tidak diizinkan.');
        }
    }

    public function create()
    {
        $this->checkRole();
        $categories = Category::all();
        return view('instructor.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->checkRole();

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => $request->price > 0 ? 'nullable|numeric|min:0|lt:price' : 'nullable',
            'discount_until' => 'nullable|date|after:now',
            'thumbnail' => 'nullable|url|max:2048',
            'thumbnail_file' => 'nullable|file|max:5120',
        ]);

        if (!$request->thumbnail && !$request->hasFile('thumbnail_file')) {
            return back()->withErrors(['thumbnail' => 'Harap berikan URL thumbnail atau unggah file gambar.'])->withInput();
        }

        $thumbnailUrl = $request->thumbnail;
        if ($request->hasFile('thumbnail_file') && $request->file('thumbnail_file')->isValid()) {
            $fileName = time() . '_' . $request->file('thumbnail_file')->getClientOriginalName();
            $request->file('thumbnail_file')->move(storage_path('app/public/course_thumbnails'), $fileName);
            $thumbnailUrl = asset('storage/course_thumbnails/' . $fileName);
        }

        Course::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->price > 0 ? $request->discount_price : null,
            'discount_until' => ($request->price > 0 && $request->discount_price) ? $request->discount_until : null,
            'thumbnail' => $thumbnailUrl,
            'status' => 'pending'
        ]);

        return redirect()->route('instructor.dashboard')->with('success', 'Kursus berhasil dibuat!');
    }

    public function edit(Course $course)
    {
        $this->checkRole();
        if ($course->user_id !== Auth::id()) abort(403);

        $categories = Category::all();
        return view('instructor.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $this->checkRole();
        if ($course->user_id !== Auth::id()) abort(403);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => $request->price > 0 ? 'nullable|numeric|min:0|lt:price' : 'nullable',
            'discount_until' => 'nullable|date|after:now',
            'thumbnail' => 'nullable|url|max:2048',
            'thumbnail_file' => 'nullable|file|max:5120',
        ]);

        $thumbnailUrl = $course->thumbnail;
        if ($request->hasFile('thumbnail_file') && $request->file('thumbnail_file')->isValid()) {
            $fileName = time() . '_' . $request->file('thumbnail_file')->getClientOriginalName();
            $request->file('thumbnail_file')->move(storage_path('app/public/course_thumbnails'), $fileName);
            $thumbnailUrl = asset('storage/course_thumbnails/' . $fileName);
        } elseif ($request->thumbnail) {
            $thumbnailUrl = $request->thumbnail;
        }

        $course->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->price > 0 ? $request->discount_price : null,
            'discount_until' => ($request->price > 0 && $request->discount_price) ? $request->discount_until : null,
            'thumbnail' => $thumbnailUrl,
        ]);

        return redirect()->route('instructor.dashboard')->with('success', 'Kursus berhasil diperbarui!');
    }

    public function destroy(Course $course)
    {
        $this->checkRole();
        if ($course->user_id !== Auth::id()) abort(403);

        $course->delete();
        return redirect()->route('instructor.dashboard')->with('success', 'Kursus berhasil dihapus!');
    }
}
