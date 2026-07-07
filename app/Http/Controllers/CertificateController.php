<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Certificate;
use App\Models\LessonProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // We fetch certificates, but wait...
        // If a user has completed a course but hasn't clicked "Download" previously, the certificate record might not exist yet!
        // We need to fetch ALL completed courses, and create certificate records if they don't exist yet, OR just show completed courses and generate on download.
        // Let's get all enrollments where progress is 100%.
        
        $completedCourses = collect();
        $enrollments = \App\Models\Enrollment::with('course.sections.lessons')->where('user_id', $user->id)->get();
        
        foreach ($enrollments as $enrollment) {
            $totalLessons = 0;
            foreach ($enrollment->course->sections as $sec) {
                $totalLessons += $sec->lessons->count();
            }
            $lessonIds = $enrollment->course->sections->flatMap->lessons->pluck('id');

            $completedLessons = LessonProgress::where('user_id', $user->id)
                ->whereIn('lesson_id', $lessonIds)
                ->where('is_completed', true)
                ->count();

            $progressPercentage = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;
            
            if ($progressPercentage == 100 && $totalLessons > 0) {
                // Ensure certificate exists in DB
                $certificate = Certificate::firstOrCreate(
                    ['user_id' => $user->id, 'course_id' => $enrollment->course_id],
                    ['certificate_code' => 'CERT-' . strtoupper(Str::random(10))]
                );
                $certificate->course = $enrollment->course;
                $completedCourses->push($certificate);
            }
        }

        return view('certificates.index', compact('completedCourses'));
    }

    public function download(Course $course)
    {
        $user = Auth::user();

        // 1. Verify enrollment
        $enrollment = $course->enrollments()->where('user_id', $user->id)->first();
        if (!$enrollment) {
            abort(403, 'Akses Ditolak: Anda tidak terdaftar di kursus ini.');
        }

        // 2. Calculate progress (same logic as my-learning.blade.php)
        $totalLessons = 0;
        foreach ($course->sections as $sec) {
            $totalLessons += $sec->lessons->count();
        }
        $lessonIds = $course->sections->flatMap->lessons->pluck('id');

        $completedLessons = LessonProgress::where('user_id', $user->id)
            ->whereIn('lesson_id', $lessonIds)
            ->where('is_completed', true)
            ->count();

        $progressPercentage = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;

        // 3. Prevent download if not 100%
        if ($progressPercentage < 100 || $totalLessons == 0) {
            abort(403, 'Akses Ditolak: Anda belum menyelesaikan kursus ini sepenuhnya.');
        }

        // 4. Create or fetch certificate record
        $certificate = Certificate::firstOrCreate(
            ['user_id' => $user->id, 'course_id' => $course->id],
            ['certificate_code' => 'CERT-' . strtoupper(Str::random(10))]
        );

        // 5. Load view and generate PDF
        $pdf = Pdf::loadView('certificates.template', compact('certificate', 'course', 'user'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('Sertifikat-' . Str::slug($course->title) . '-' . $user->name . '.pdf');
    }

    public function verify($code)
    {
        $certificate = Certificate::with(['user', 'course'])->where('certificate_code', $code)->firstOrFail();
        return view('certificates.verify', compact('certificate'));
    }
}
