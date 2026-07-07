<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Notifications\LmsNotification;
use Carbon\Carbon;

class NotifyAssignmentDeadlines extends Command
{
    protected $signature = 'lms:notify-deadlines';
    protected $description = 'Notify students of upcoming assignment deadlines';

    public function handle()
    {
        // Get assignments due in the next 24 hours
        $assignments = Assignment::whereBetween('due_date', [Carbon::now(), Carbon::now()->addDay()])->get();

        foreach ($assignments as $assignment) {
            $course = $assignment->lesson->section->course;
            $students = $course->enrollments()->with('user')->get()->pluck('user');

            foreach ($students as $student) {
                // Check if student has already submitted
                $hasSubmitted = AssignmentSubmission::where('assignment_id', $assignment->id)
                    ->where('user_id', $student->id)
                    ->exists();

                if (!$hasSubmitted) {
                    $student->notify(new LmsNotification([
                        'title' => 'Deadline Tugas Mendekat!',
                        'message' => "Tugas \"{$assignment->title}\" pada kursus \"{$course->title}\" akan segera berakhir dalam 24 jam.",
                        'link' => route('courses.watch', [$course->slug, $assignment->lesson_id]),
                        'icon' => 'fa-solid fa-clock'
                    ]));
                }
            }
        }

        $this->info('Deadline notifications sent successfully.');
    }
}
