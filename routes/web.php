<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [HomeController::class, 'viewHomePage'])->name('home')->middleware('auth');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/admindashboard', [AdminController::class, 'viewAdminDashboard'])->name('admindashboard');
});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/teacher/teacherdashboard', [TeacherController::class, 'viewTeacherDashboard'])->name('teacherdashboard');
});
