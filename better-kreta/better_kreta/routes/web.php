<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Auth\Authenticatable;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(Authenticate::class)->group(function () {
Route::resource('/courses', App\Http\Controllers\CourseController::class);


Route::resource('/students', App\Http\Controllers\StudentController::class);
Route::get('/student/show_deleted', [App\Http\Controllers\StudentController::class, 'show_deleted'])->name('students.show_deleted');
Route::put('/students/restore/{student}', [App\Http\Controllers\StudentController::class, 'restore'])->name('students.restore')->withTrashed();

Route::resource('/schooldays', App\Http\Controllers\SchoolDayController::class);
Route::get('/schoolday/show_deleted', [App\Http\Controllers\SchoolDayController::class, 'show_deleted'])->name('schooldays.show_deleted');
Route::put('/schooldays/restore/{schoolday}', [App\Http\Controllers\SchoolDayController::class, 'restore'])->name('schooldays.restore')->withTrashed();

Route::resource('/presences', App\Http\Controllers\PresenceController::class);
});