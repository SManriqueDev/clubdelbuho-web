<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomKeyController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* Student */
Route::group(['prefix' => 'student'], function () {
    Route::get('/', [StudentController::class, 'index']);
});


/* Admin */
// Route::redirect('/', '/admin', 301);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // Dashboards
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Exercises
    Route::get('exercises', [ExercisesController::class, 'index'])->name('admin.exercises');
    Route::post('exercises', [ExercisesController::class, 'store'])->name('admin.exercises.store');
    Route::get('exercises/{exercise_type}/create', [ExercisesController::class, 'create'])->name('admin.exercises.create');
    Route::get('exercises/{exercise}/edit', [ExercisesController::class, 'edit'])->name('admin.exercises.edit');

    // Classroom Keys
    Route::get('classroomkeys', [ClassroomKeyController::class, 'index'])->name('admin.classroomkeys.index');

    Route::get('classrooms', [ClassroomController::class, 'index'])->name('admin.classrooms.index');
    Route::post('classrooms', [ClassroomController::class, 'store'])->name('admin.classrooms.store');
});

// Auth
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register')->middleware('guest');
Route::post('register', [RegisterController::class, 'register'])->name('register.submit')->middleware('guest');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'login'])->name('login.attempt')->middleware('guest');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Users

Route::get('users', [UsersController::class, 'index'])->name('users')->middleware('remember', 'auth');

Route::get('users/create', [UsersController::class, 'create'])->name('users.create')->middleware('auth');

Route::post('users', [UsersController::class, 'store'])->name('users.store')->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit')->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])->name('users.update')->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])->name('users.destroy')->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])->name('users.restore')->middleware('auth');

// Images
Route::get('/img/{path}', [ImagesController::class, 'show'])->where('path', '.*');

// 500 error
Route::get('500', function () {
    // Force debug mode for this endpoint in the demo environment
    if (App::environment('demo')) {
        Config::set('app.debug', true);
    }

    echo $fail;
});
