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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'viewLoginPage'])->name('login');
Route::post('/', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::get('/register', [RegisterController::class, 'viewRegisterPage'])->name('register');
Route::post('/register', [RegisterController::class, 'storeRegisterUsers'])->name('register.store');

//User Side protected routes
Route::get('/home', [HomeController::class, 'viewHomePage'])->name('home')->middleware('auth');
Route::get('/exam', [ExamController::class, 'viewExamPage'])->name('exam')->middleware('auth');
Route::get('/notice', [NoticeController::class, 'viewNoticePage'])->name('notice')->middleware('auth');
Route::get('/about', [AboutUsController::class, 'viewAboutUsPage'])->name('about')->middleware('auth');
Route::get('/contact', [ContactUsController::class, 'viewContactUsPage'])->name('contact')->middleware('auth');

// Admin side protected routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/admindashboard', [AdminController::class, 'viewAdminDashboard'])->name('admindashboard');
    Route::get('/admin/userManagement', [UserManagementController::class, 'viewUserManagementPage'])->name('userManagement');
    Route::get('/admin/examResult', [ExamResultController::class, 'viewExamResultPage'])->name('examResult');
    Route::get('/admin/inquiryManagement', [InquiryManagementController::class, 'viewInquiryManagementPage'])->name('inquiryManagement');
    Route::get('/admin/notify', [AdminNotifyController::class, 'viewNotifyPage'])->name('adminNotify');
    Route::get('/admin/analyze', [AdminAnalyzeController::class, 'viewAnalyzePage'])->name('adminAnalyze');
});


// Teacher side protected routes
Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/teacher/teacherdashboard', [TeacherController::class, 'viewTeacherDashboard'])->name('teacherdashboard');
    Route::get('/teacher/examManagement', [ExamManagementController::class, 'viewExamManagementPage'])->name('examManagement');
    Route::get('/teacher/analyze', [TeacherAnalyzeController::class, 'viewAnalyzePage'])->name('teacherAnalyze');
    Route::get('/teacher/notify', [TeacherNotifyController::class, 'viewNotifyPage'])->name('teacherNotify');
});
