<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExamController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ExamManagementController;
use App\Http\Controllers\TeacherAnalyzeController;
use App\Http\Controllers\TeacherNotifyController;

use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\InquiryManagementController;
use App\Http\Controllers\AdminNotifyController;
use App\Http\Controllers\AdminAnalyzeController;
use App\Http\Controllers\TeacherExamMarksController;

use App\Http\Controllers\ProfileController;

use App\Models\Inquiry;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LoginController::class, 'viewLoginPage'])->name('login');
Route::post('/', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::get('/register', [RegisterController::class, 'viewRegisterPage'])->name('register');
Route::post('/register', [RegisterController::class, 'storeRegisterUsers'])->name('register.store');

// User Side protected routes
Route::middleware('auth')->group(function () {
    Route::get('/student/home', [HomeController::class, 'viewHomePage'])->name('home');
    Route::get('/student/exam', [ExamController::class, 'viewExamPage'])->name('exam');
    Route::get('/student/notice', [NoticeController::class, 'viewNoticePage'])->name('student.notices');
    Route::get('/student/about', [AboutUsController::class, 'viewAboutUsPage'])->name('about');
    Route::get('/student/contact', [ContactUsController::class, 'viewContactUsPage'])->name('contact');

    Route::get('/student/exams', [ExamController::class, 'index'])->name('student.exams');
    Route::get('/student/exam/{id}', [ExamController::class, 'start'])->name('student.exam.start');
    Route::post('/student/exam/{id}/submit', [ExamController::class, 'submit'])->name('student.exam.submit');

    Route::post('/contact', [ContactUsController::class, 'submitContactUsForm'])->name('contact_us.submit');
    Route::post('/contact/inquiry', [ContactUsController::class, 'submitInquiryForm'])->name('submit_inquiry');

    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/upload', [ProfileController::class, 'uploadImage'])->name('profile.upload');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Admin side protected routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/admindashboard', [AdminController::class, 'viewAdminDashboard'])->name('admindashboard');
    Route::get('/admin/userManagement', [UserManagementController::class, 'viewUserManagementPage'])->name('userManagement');
    Route::get('/admin/examResult', [ExamResultController::class, 'viewExamResultPage'])->name('examResult');
    Route::get('/admin/inquiryManagement', [InquiryManagementController::class, 'viewInquiryManagementPage'])->name('inquiryManagement');
    Route::get('/admin/notify', [AdminNotifyController::class, 'viewNotifyPage'])->name('adminNotify');
    Route::get('/admin/analyze', [AdminAnalyzeController::class, 'viewAnalyzePage'])->name('adminAnalyze');

    // User Resource Actions
    Route::post('/admin/userManagement', [UserManagementController::class, 'store'])->name('userManagement.store');
    Route::put('/admin/userManagement/{id}', [UserManagementController::class, 'update'])->name('userManagement.update');
    Route::delete('/admin/userManagement/{id}', [UserManagementController::class, 'destroy'])->name('userManagement.destroy');

    Route::delete('/admin/inquiryManagement/{id}', [InquiryManagementController::class, 'destroy'])->name('inquiryManagement.destroy');

    Route::post('/admin/userManagement/import', [UserManagementController::class, 'importExcel'])->name('userManagement.import');
    Route::get('/admin/userManagement/export', [UserManagementController::class, 'exportExcel'])->name('userManagement.export');

    Route::get('/admin/contactManagement', [ContactUsController::class, 'viewAdminContactPage'])->name('contactManagement');
    Route::delete('/admin/contactManagement/{id}', [ContactUsController::class, 'destroy'])->name('contactManagement.destroy');
    Route::post('/admin/contactManagement/{id}/reply', [ContactUsController::class, 'sendReplyEmail'])->name('contactManagement.reply');
});

// Teacher side protected routes
Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/teacher/teacherdashboard', [TeacherController::class, 'viewTeacherDashboard'])->name('teacherdashboard');
    Route::get('/teacher/examManagement', [ExamManagementController::class, 'viewExamManagementPage'])->name('examManagement');
    Route::get('/teacher/analyze', [TeacherAnalyzeController::class, 'viewAnalyzePage'])->name('teacherAnalyze');
    Route::get('/teacher/notify', [TeacherNotifyController::class, 'viewNotifyPage'])->name('teacherNotify');

    Route::post('/teacher/examManagement', [ExamManagementController::class, 'store'])->name('assessment.store');
    Route::get('/assessment/{id}/questions', [ExamManagementController::class, 'questionPage'])->name('assessment.questions');
    Route::post('/assessment/{id}/questions', [ExamManagementController::class, 'storeQuestion'])->name('assessment.questions.store');

    Route::get('/teacher/examMarks', [TeacherExamMarksController::class, 'viewExamMarks'])->name('teacher.examMarks');
    Route::get('/exam-marks', [ExamManagementController::class, 'examMarks'])->name('examMarks');

    Route::post('/teacher/notify', [NoticeController::class, 'store'])->name('teacherNotify.store');
    Route::get('/teacher/notify/{id}/edit', [NoticeController::class, 'edit'])->name('teacherNotify.edit');
    Route::put('/teacher/notify/{id}', [NoticeController::class, 'update'])->name('teacherNotify.update');
    Route::delete('/teacher/notify/{id}', [NoticeController::class, 'destroy'])->name('teacherNotify.destroy');
});
