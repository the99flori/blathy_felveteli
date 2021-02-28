<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function(){
    return redirect('/schedule');
})->name('home');

Route::get('/login', [AuthController::class, 'oauth'])->name('login');
Route::get('/login/local', [AuthController::class, 'login'])->name('login.local');
Route::post('/login/local', [AuthController::class, 'loginPost']);
Route::get('/callback', [AuthController::class, 'callback'])->name('callback');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/schedule', [StudentController::class, 'login'])->name('schedule');
Route::post('/schedule', [StudentController::class, 'index'])->name('schedule.index');


Route::get('/school', [StudentController::class, 'getSchoolData'])->name('omschools')->middleware('auth');

Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {

    Route::get('/', [AdminController::class, 'dashboardIndex'])->name('index');

    Route::prefix('import')->name('import.')->group(function () {
        Route::get('/', [AdminController::class, 'importView'])->name('get');
        Route::post('/', [AdminController::class, 'import'])->name('post');
    });

    Route::prefix('student')->name('student.')->group(function () {

        Route::prefix('oralexam')->name('oralexam.')->group(function () {
            Route::get('/', [AdminController::class, 'getStudentOralExamInfoIndex'])->name('index');
            Route::post('/', [AdminController::class, 'getStudentOralExamInfoRequest'])->name('request');
            Route::get('/{id}', [AdminController::class, 'getStudentOralExamInfo'])->name('info');
        });
    });
});



