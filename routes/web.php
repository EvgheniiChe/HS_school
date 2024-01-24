<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Админские роуты
    Route::middleware('role:admin')
        ->namespace('App\Http\Controllers\Admins\\')
        ->prefix('admins')
        ->name('admins.')
        ->group(function () {

            Route::prefix('course-types')
                ->name('course-types.')
                ->controller('CourseTypesController')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::get('/{courseType}', 'show')->name('show');
                    Route::patch('/{courseType}', 'update')->name('update');
                    Route::delete('/{courseType}', 'destroy')->name('delete');
                });

            Route::prefix('courses/{course}/student-group')
                ->name('courses.student-group.')
                ->controller('GroupsController')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/{student}', 'store')->name('store');
                    Route::delete('/{student}', 'destroy')->name('delete');
                });

            Route::resource('courses/{course}/lessons', 'LessonsController')
                ->only(['index', 'store', 'show', 'update', 'destroy']);

            Route::prefix('courses')
                ->name('courses.')
                ->controller('CoursesController')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::get('/{course}', 'show')->name('show');
                    Route::patch('/{course}', 'update')->name('update');
                    Route::delete('/{course}', 'destroy')->name('delete');
                });

            Route::patch('users/{user}/role', 'UserRolesController')
                ->name('users.role');

            Route::get('users', 'UsersController')
                ->name('users');
        });

    // Менеджерские роуты
    Route::middleware('role:manager')
        ->namespace('App\Http\Controllers\Managers\\')
        ->prefix('managers')
        ->name('managers.')
        ->group(function () {

            Route::prefix('course-types')
                ->name('course-types.')
                ->controller('CourseTypesController')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::get('/{courseType}', 'show')->name('show');
                    Route::patch('/{courseType}', 'update')->name('update');
                    Route::delete('/{courseType}', 'destroy')->name('delete');
                });

            Route::prefix('courses/{course}/student-group')
                ->name('courses.student-group.')
                ->controller('GroupsController')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/{student}', 'store')->name('store');
                    Route::delete('/{student}', 'destroy')->name('delete');
                });

            Route::resource('courses/{course}/lessons', 'LessonsController')
                ->only(['index', 'show']);

            Route::prefix('courses')
                ->name('courses.')
                ->controller('CoursesController')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'store')->name('store');
                    Route::get('/{course}', 'show')->name('show');
                    Route::patch('/{course}', 'update')->name('update');
                    Route::delete('/{course}', 'destroy')->name('delete');
                });

            Route::get('users', 'UsersController')
                ->name('users');
        });

    // Учительские роуты
    Route::middleware('role:staff')
        ->namespace('App\Http\Controllers\Staff\\')
        ->prefix('staff')
        ->name('staff.')
        ->group(function () {
            Route::patch('homework-solution-status', 'HomeworkSolutionStatusesController')
                ->name('homework-solution-status');

            Route::resource('homework-solutions/{solution}/message', 'HomeworkSolutionMessagesController')
                ->only('index', 'post');

            Route::resource('courses/{course}/lessons/{lesson}/homeworks', 'HomeworksController')
                ->only(['store', 'show', 'update', 'destroy']);

            Route::resource('courses/{course}/lessons', 'LessonsController')
                ->only(['index', 'store', 'show', 'update', 'destroy']);

            Route::prefix('courses')
                ->name('courses.')
                ->controller('CoursesController')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{course}', 'show')->name('show');
                });

            Route::get('users', 'UsersController')
                ->name('users');
        });

    // Ученические роуты
    Route::middleware('role:student')
        ->namespace('App\Http\Controllers\Students\\')
        ->prefix('students')
        ->name('students.')
        ->group(function () {
            Route::resource('homework-solutions/{solution}/message', 'HomeworkSolutionMessagesController')
                ->only(['index', 'store']);

            Route::resource('homeworks', 'HomeworksController')
                ->only(['show']);

            Route::resource('courses/{course}/lessons', 'LessonsController')
                ->only(['index', 'show']);

            Route::resource('courses', 'CoursesController')
                ->only(['index', 'show']);
        });
});
