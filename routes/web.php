<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AboutController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/course/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/course/{slug}/watch/{lesson}', [CourseController::class, 'watch'])->name('courses.watch');
Route::get('/verify-certificate/{code}', [\App\Http\Controllers\CertificateController::class, 'verify'])->name('certificate.verify');
Route::get('/help-center', [\App\Http\Controllers\HelpCenterController::class, 'index'])->name('help-center');
Route::get('/terms-conditions', [\App\Http\Controllers\LegalController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [\App\Http\Controllers\LegalController::class, 'privacy'])->name('privacy');



// Forum Routes
Route::prefix('forum')->name('forum.')->group(function() {
    Route::get('/', [\App\Http\Controllers\ForumController::class, 'index'])->name('index');
    Route::get('/category/{category:slug}', [\App\Http\Controllers\ForumController::class, 'category'])->name('category');
    Route::get('/thread/{thread:slug}', [\App\Http\Controllers\ForumController::class, 'thread'])->name('thread');
    
    Route::middleware('auth')->group(function() {
        Route::get('/create/{category:slug?}', [\App\Http\Controllers\ForumController::class, 'createThread'])->name('create');
        Route::post('/create', [\App\Http\Controllers\ForumController::class, 'storeThread'])->name('store');
        Route::post('/thread/{thread:slug}/reply', [\App\Http\Controllers\ForumController::class, 'storeReply'])->name('reply.store');
    });
});

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/login/captcha-image', [AuthController::class, 'loginCaptchaImage'])->name('login.captcha')->middleware('guest');
Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('auth.google.redirect')->middleware('guest');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback')->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

use App\Http\Controllers\InstructorController;
use App\Http\Controllers\InstructorCourseController;
use App\Http\Controllers\InstructorCurriculumController;

Route::middleware('auth')->group(function () {
    // Notification Routes
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'getNotifications'])->name('notifications.get');
    Route::post('/notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [\App\Http\Controllers\NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');

    Route::post('/course/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::post('/enrollment/{enrollment}/terminate', [CourseController::class, 'terminateEnrollment'])->name('courses.terminate');


    Route::get('/my-learning', [CourseController::class, 'myLearning'])->name('my-learning');
    Route::post('/progress/{lesson}/complete', [CourseController::class, 'markCompleted'])->name('progress.complete');
    Route::post('/course/{course}/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('course.review');
    Route::delete('/review/{review}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('course.review.destroy');
    Route::get('/certificate/{course}/download', [\App\Http\Controllers\CertificateController::class, 'download'])->name('certificate.download');
    Route::get('/my-certificates', [\App\Http\Controllers\CertificateController::class, 'index'])->name('certificates.index');

    // Profile Terminal Route
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // QnA Routes
    Route::post('/course/{course}/lesson/{lesson}/qa', [\App\Http\Controllers\QnaController::class, 'storeQuestion'])->name('qna.store');
    Route::post('/qa/{question}/reply', [\App\Http\Controllers\QnaController::class, 'storeReply'])->name('qna.reply');
    Route::post('/qa/{question}/resolve', [\App\Http\Controllers\QnaController::class, 'resolveQuestion'])->name('qna.resolve');
    Route::delete('/qa/{question}', [\App\Http\Controllers\QnaController::class, 'destroyQuestion'])->name('qna.destroy');

    // Quiz Route
    Route::post('/lesson/{lesson}/quiz', [\App\Http\Controllers\QuizController::class, 'submitQuiz'])->name('quiz.submit');

    // Assignment Route
    Route::post('/lesson/{lesson}/assignment/{assignment}', [\App\Http\Controllers\StudentAssignmentController::class, 'submit'])->name('assignment.submit');

    // Instructor Routes
    Route::get('/become-instructor', [InstructorController::class, 'becomeInstructor'])->name('instructor.become');
    Route::get('/instructor/dashboard', [InstructorController::class, 'dashboard'])->name('instructor.dashboard');

    // Instructor Earnings & Analytics
    Route::get('/instructor/earnings', [\App\Http\Controllers\InstructorEarningsController::class, 'index'])->name('instructor.earnings');
    Route::post('/instructor/earnings/payout', [\App\Http\Controllers\InstructorEarningsController::class, 'requestPayout'])->name('instructor.earnings.payout');

    // Instructor Reviews
    Route::get('/instructor/reviews', [InstructorController::class, 'reviews'])->name('instructor.reviews');
    Route::post('/instructor/reviews/{review}/reply', [\App\Http\Controllers\ReviewController::class, 'reply'])->name('instructor.reviews.reply');

    // Instructor Course CRUD
    Route::resource('instructor/courses', InstructorCourseController::class)->except(['index', 'show'])->names('instructor.courses');

    // Instructor Curriculum Builder
    Route::get('/instructor/courses/{course}/curriculum', [InstructorCurriculumController::class, 'index'])->name('instructor.curriculum.index');
    Route::post('/instructor/courses/{course}/sections', [InstructorCurriculumController::class, 'storeSection'])->name('instructor.sections.store');
    Route::put('/instructor/courses/{course}/sections/{section}', [InstructorCurriculumController::class, 'updateSection'])->name('instructor.sections.update');
    Route::delete('/instructor/courses/{course}/sections/{section}', [InstructorCurriculumController::class, 'destroySection'])->name('instructor.sections.destroy');

    Route::get('/instructor/courses/{course}/sections/{section}/lessons/create', [InstructorCurriculumController::class, 'createLesson'])->name('instructor.lessons.create');
    Route::post('/instructor/courses/{course}/sections/{section}/lessons', [InstructorCurriculumController::class, 'storeLesson'])->name('instructor.lessons.store');
    Route::put('/instructor/courses/{course}/sections/{section}/lessons/{lesson}', [InstructorCurriculumController::class, 'updateLesson'])->name('instructor.lessons.update');
    Route::delete('/instructor/courses/{course}/sections/{section}/lessons/{lesson}', [InstructorCurriculumController::class, 'destroyLesson'])->name('instructor.lessons.destroy');

    // Instructor Quiz Routes
    Route::get('/instructor/courses/{course}/lessons/{lesson}/quiz', [\App\Http\Controllers\InstructorQuizController::class, 'index'])->name('instructor.quiz.index');
    Route::post('/instructor/courses/{course}/lessons/{lesson}/quiz', [\App\Http\Controllers\InstructorQuizController::class, 'store'])->name('instructor.quiz.store');
    Route::put('/instructor/courses/{course}/lessons/{lesson}/quiz/duration', [\App\Http\Controllers\InstructorQuizController::class, 'updateDuration'])->name('instructor.quiz.updateDuration');
    Route::delete('/instructor/courses/{course}/lessons/{lesson}/quiz/{quizQuestion}', [\App\Http\Controllers\InstructorQuizController::class, 'destroy'])->name('instructor.quiz.destroy');
    Route::get('/instructor/courses/{course}/lessons/{lesson}/quiz/results', [\App\Http\Controllers\InstructorQuizController::class, 'results'])->name('instructor.quiz.results');
    Route::delete('/instructor/courses/{course}/lessons/{lesson}/quiz/results/{quizResult}/reset', [\App\Http\Controllers\InstructorQuizController::class, 'resetResult'])->name('instructor.quiz.reset');

    // Instructor Assignments Routes
    Route::get('/instructor/courses/{course}/lessons/{lesson}/assignments', [\App\Http\Controllers\InstructorAssignmentController::class, 'index'])->name('instructor.assignments.index');
    Route::post('/instructor/courses/{course}/lessons/{lesson}/assignments', [\App\Http\Controllers\InstructorAssignmentController::class, 'store'])->name('instructor.assignments.store');
    Route::put('/instructor/courses/{course}/lessons/{lesson}/assignments/{assignment}', [\App\Http\Controllers\InstructorAssignmentController::class, 'update'])->name('instructor.assignments.update');
    Route::delete('/instructor/courses/{course}/lessons/{lesson}/assignments/{assignment}', [\App\Http\Controllers\InstructorAssignmentController::class, 'destroy'])->name('instructor.assignments.destroy');
    Route::get('/instructor/courses/{course}/lessons/{lesson}/assignments/{assignment}/submissions', [\App\Http\Controllers\InstructorAssignmentController::class, 'submissions'])->name('instructor.assignments.submissions');
    Route::put('/instructor/courses/{course}/lessons/{lesson}/assignments/{assignment}/submissions/{submission}/grade', [\App\Http\Controllers\InstructorAssignmentController::class, 'grade'])->name('instructor.assignments.grade');

    // --- Admin Routes ---
    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Withdrawals Management
    Route::get('/admin/withdrawals', [\App\Http\Controllers\AdminController::class, 'withdrawals'])->name('admin.withdrawals');
    Route::put('/admin/withdrawals/{withdrawal}', [\App\Http\Controllers\AdminController::class, 'updateWithdrawal'])->name('admin.withdrawals.update');
    Route::delete('/admin/withdrawals/{withdrawal}', [\App\Http\Controllers\AdminController::class, 'destroyWithdrawal'])->name('admin.withdrawals.destroy');

    // User Management
    Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{user}/edit', [\App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [\App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::put('/admin/users/{user}/role', [\App\Http\Controllers\AdminController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::post('/admin/users/{user}/purge-ledger', [\App\Http\Controllers\AdminController::class, 'purgeLedger'])->name('admin.users.purgeLedger');
    Route::post('/admin/global/purge-ledger', [\App\Http\Controllers\AdminController::class, 'purgeGlobalLedger'])->name('admin.global.purgeLedger');
    Route::delete('/admin/users/{user}', [\App\Http\Controllers\AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // Course Management
    Route::get('/admin/courses', [\App\Http\Controllers\AdminController::class, 'courses'])->name('admin.courses');
    Route::get('/admin/verification', [\App\Http\Controllers\AdminController::class, 'verificationQueue'])->name('admin.verification');
    Route::put('/admin/courses/{course}/status', [\App\Http\Controllers\AdminController::class, 'updateCourseStatus'])->name('admin.courses.updateStatus');
    Route::delete('/admin/courses/{course}', [\App\Http\Controllers\AdminController::class, 'destroyCourse'])->name('admin.courses.destroy');

    // Payment Verification
    Route::get('/admin/payments', [\App\Http\Controllers\AdminController::class, 'payments'])->name('admin.payments');
    Route::put('/admin/payments/{enrollment}/verify', [\App\Http\Controllers\AdminController::class, 'verifyPayment'])->name('admin.payments.verify');
    Route::delete('/admin/payments/{enrollment}', [\App\Http\Controllers\AdminController::class, 'destroyEnrollment'])->name('admin.payments.destroy');

    // Category Management
    Route::get('/admin/categories', [\App\Http\Controllers\AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/admin/categories', [\App\Http\Controllers\AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/admin/categories/{category}', [\App\Http\Controllers\AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');

    // Announcement Management
    Route::get('/admin/announcements', [\App\Http\Controllers\AdminAnnouncementController::class, 'index'])->name('admin.announcements.index');
    Route::post('/admin/announcements', [\App\Http\Controllers\AdminAnnouncementController::class, 'store'])->name('admin.announcements.store');
    Route::patch('/admin/announcements/{announcement}/toggle', [\App\Http\Controllers\AdminAnnouncementController::class, 'toggle'])->name('admin.announcements.toggle');
    Route::delete('/admin/announcements/{announcement}', [\App\Http\Controllers\AdminAnnouncementController::class, 'destroy'])->name('admin.announcements.destroy');

    // Certificate Management
    Route::get('/admin/certificates', [\App\Http\Controllers\AdminController::class, 'certificates'])->name('admin.certificates');

    // Finance Management
    Route::get('/admin/finance', [\App\Http\Controllers\AdminController::class, 'finance'])->name('admin.finance');

    // Settings Management
    Route::get('/admin/settings', [\App\Http\Controllers\AdminSettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/admin/settings', [\App\Http\Controllers\AdminSettingController::class, 'update'])->name('admin.settings.update');
    Route::get('/lms-ratings', [\App\Http\Controllers\LmsRatingController::class, 'index'])->name('lms-rating.index');
    Route::post('/lms-rating', [\App\Http\Controllers\LmsRatingController::class, 'store'])->name('lms-rating.store');
    Route::delete('/lms-rating/{lmsRating}', [\App\Http\Controllers\LmsRatingController::class, 'destroy'])->name('lms-rating.destroy');
    // Banner Management
    Route::get('/banners', [\App\Http\Controllers\BannerController::class, 'index'])->name('banners.index');
    Route::post('/banners', [\App\Http\Controllers\BannerController::class, 'store'])->name('banners.store');
    Route::patch('/banners/{banner}/toggle', [\App\Http\Controllers\BannerController::class, 'toggle'])->name('banners.toggle');
    Route::delete('/banners/{banner}', [\App\Http\Controllers\BannerController::class, 'destroy'])->name('banners.destroy');
});
