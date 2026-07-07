<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentAssignmentController extends Controller
{
    public function submit(Request $request, $lessonId, Assignment $assignment)
    {
        $request->validate([
            'text_content' => 'nullable|string',
            'file' => 'nullable|file|max:20480'
        ]);

        if ($assignment->due_date && \Carbon\Carbon::parse($assignment->due_date)->isPast()) {
            return back()->with('error_assignment', 'Batas waktu untuk tugas ini telah berakhir. Pengiriman tidak lagi diterima.');
        }

        $existingSubmission = AssignmentSubmission::where('assignment_id', $assignment->id)->where('user_id', Auth::id())->first();

        if (!$request->text_content && !$request->hasFile('file') && !$existingSubmission) {
            return back()->with('error_assignment', 'Harap berikan respons teks atau file.');
        }

        $filePath = null;
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(storage_path('app/public/assignments'), $fileName);
            $filePath = 'assignments/' . $fileName;
        }

        if ($existingSubmission) {
            $existingSubmission->update([
                'text_content' => $request->text_content ?: $existingSubmission->text_content,
                'file_path' => $filePath ?: $existingSubmission->file_path,
                'status' => 'pending',
                'score' => null,
                'feedback' => null
            ]);
        } else {
            AssignmentSubmission::create([
                'assignment_id' => $assignment->id,
                'user_id' => Auth::id(),
                'text_content' => $request->text_content,
                'file_path' => $filePath,
                'status' => 'pending'
            ]);
        }

        return back()->with('success_assignment', 'Tugas berhasil dikirim!');
    }
}
