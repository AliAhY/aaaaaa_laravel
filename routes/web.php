<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\OfferedCoursesController;
use App\Http\Controllers\StagesController;
use Illuminate\Support\Facades\Route;


Route::get('/import-excel', [ExcelImportController::class, 'importform'])->name('importform');
Route::post('/import-excel', [ExcelImportController::class, 'import'])->name('import.excel');


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_check'])->name('login_check');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group([
    'prefix' => '/',
    'middleware' => ['IsAdmin'],

], function () {

    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::resource('members', MembersController::class);
    Route::resource('courses', CoursesController::class);
    Route::resource('offered_courses', OfferedCoursesController::class);
    Route::resource('stages', StagesController::class);

    Route::get('/course/{id}/members', [CoursesController::class, 'members']);
    Route::post('/course/{id}/add_member', [CoursesController::class, 'add_member']);
    Route::delete('/delete_member/{id}', [CoursesController::class, 'delete_member'])->name('members.destroy');


    // session
    Route::get('/course/{id}/sessions', [CoursesController::class, 'sessions']);
    Route::post('/course/{id}/add_session', [CoursesController::class, 'add_session']);
    Route::delete('/delete_session/{id}', [CoursesController::class, 'delete_session'])->name('sessions.destroy');

    // الحضور
    Route::get('courses/{course}/days/{day}/audience', [CoursesController::class, 'showAudience'])->name('courses.audience.show');
    Route::put('courses/{course}/days/{day}/audience', [CoursesController::class, 'updateAudience'])->name('courses.audience.update');
    // نسبة الحضور
    Route::get('courses/{id}/attendance_rate', [CoursesController::class, 'attendance_rate'])->name('courses.attendance_rate');

});
