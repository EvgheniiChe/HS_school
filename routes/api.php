<?php

use App\Http\Controllers\CourseTypesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
