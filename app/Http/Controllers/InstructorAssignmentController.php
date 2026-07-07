<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;

class InstructorAssignmentController extends Controller
{
    public function index(Course $course, Lesson $lesson)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403);
        }

        $assignments = $lesson->assignments()->withCount('submissions')->get();
        $totalEnrolled = $course->enrollments()->count();

        return view('instructor.courses.assignments_index', compact('course', 'lesson', 'assignments', 'totalEnrolled'));
    }

    public function store(Request $request, Course $course, Lesson $lesson)
    {
        if ($course->user_id !== Auth::id()) abort(403);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'max_score' => 'required|integer|min:1',
            'due_date' => 'nullable|date',
            'attachment' => 'nullable|file|max:10240',
            'criteria_name.*' => 'nullable|string',
            'criteria_weight.*' => 'nullable|integer|min:0|max:100'
        ]);

        $criteria = [];
        if ($request->criteria_name) {
            foreach ($request->criteria_name as $key => $name) {
                if ($name && isset($request->criteria_weight[$key])) {
                    $criteria[] = [
                        'name' => $name,
                        'weight' => (int) $request->criteria_weight[$key]
                    ];
                }
            }
        }

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('assignments/attachments', 'public');
        }

        $newAssignment = $lesson->assignments()->create([
            'title' => $request->title,
            'description' => $request->description,
            'grading_criteria' => $criteria,
            'max_score' => $request->max_score,
            'due_date' => $request->due_date,
            'attachment' => $attachmentPath
        ]);

        // Notify Enrolled Students
        $students = $course->enrollments()->with('user')->get()->pluck('user');
        foreach ($students as $student) {
            if ($student) {
                $student->notify(new \App\Notifications\LmsNotification([
                    'title' => 'Tugas Baru Tersedia!',
                    'message' => "Tugas baru \"{$request->title}\" telah ditambahkan pada kursus \"{$course->title}\". Periksa segera!",
                    'link' => route('courses.watch', [$course->slug, $lesson->id]),
                    'icon' => 'fa-solid fa-file-signature'
                ]));
            }
        }

        return back()->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function update(Request $request, Course $course, Lesson $lesson, Assignment $assignment)
    {
        if ($course->user_id !== Auth::id()) abort(403);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'max_score' => 'required|integer|min:1',
            'due_date' => 'nullable|date',
            'attachment' => 'nullable|file|max:10240',
            'criteria_name.*' => 'nullable|string',
            'criteria_weight.*' => 'nullable|integer|min:0|max:100'
        ]);

        $criteria = [];
        if ($request->criteria_name) {
            foreach ($request->criteria_name as $key => $name) {
                if ($name && isset($request->criteria_weight[$key])) {
                    $criteria[] = [
                        'name' => $name,
                        'weight' => (int) $request->criteria_weight[$key]
                    ];
                }
            }
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'grading_criteria' => $criteria,
            'max_score' => $request->max_score,
            'due_date' => $request->due_date
        ];

        if ($request->hasFile('attachment')) {
            if ($assignment->attachment) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($assignment->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('assignments/attachments', 'public');
        }

        $assignment->update($data);

        return back()->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy(Course $course, Lesson $lesson, Assignment $assignment)
    {
        if ($course->user_id !== Auth::id()) abort(403);

        $assignment->delete();
        return back()->with('success', 'Tugas dihapus.');
    }

    public function submissions(Course $course, Lesson $lesson, Assignment $assignment)
    {
        if ($course->user_id !== Auth::id()) abort(403);

        $submissions = $assignment->submissions()->with('user')->get();
        $submittedUserIds = $submissions->pluck('user_id')->toArray();

        // Get enrolled students who have not submitted
        $missingStudents = $course->enrollments()
            ->with('user')
            ->whereNotIn('user_id', $submittedUserIds)
            ->get()
            ->pluck('user');

        return view('instructor.courses.assignment_submissions', compact('course', 'lesson', 'assignment', 'submissions', 'missingStudents'));
    }

    public function grade(Request $request, Course $course, Lesson $lesson, Assignment $assignment, AssignmentSubmission $submission)
    {
        if ($course->user_id !== Auth::id()) abort(403);

        $request->validate([
            'score' => 'required|numeric|min:0|max:' . $assignment->max_score,
            'feedback' => 'nullable|string',
            'criteria_score.*' => 'nullable|numeric|min:0',
            'criteria_review.*' => 'nullable|string'
        ]);

        $criteriaScores = [];
        if ($request->criteria_score) {
            foreach ($request->criteria_score as $key => $score) {
                $criteriaScores[] = [
                    'name' => $key,
                    'score' => (float) $score,
                    'review' => $request->criteria_review[$key] ?? ''
                ];
            }
        }

        $submission->update([
            'score' => $request->score,
            'criteria_scores' => $criteriaScores,
            'feedback' => $request->feedback,
            'status' => 'graded'
        ]);

        return back()->with('success', 'Pengiriman berhasil dinilai!');
    }
}
