<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CourseTypesController;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\StudentToCourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('course-types')
    ->name('course-types.')
    ->controller(CourseTypesController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{courseType}', 'show')->name('show');
        Route::patch('/{courseType}', 'update')->name('update');
        Route::delete('/{courseType}', 'destroy')->name('delete');
    });


Route::resource('courses/{course}/lessons', LessonsController::class)
    ->only(['index', 'store', 'show', 'update', 'destroy']);

Route::prefix('courses')
    ->name('courses.')
    ->controller(CoursesController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{course}', 'show')->name('show');
        Route::patch('/{course}', 'update')->name('update');
        Route::delete('/{course}', 'destroy')->name('delete');
    });

Route::prefix('student-to-course')
    ->name('student-to-course.')
    ->controller(StudentToCourseController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{studentCourse}', 'show')->name('show');
        Route::patch('/{studentCourse}', 'update')->name('update');
        Route::delete('/{studentCourse}', 'destroy')->name('delete');
    });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
