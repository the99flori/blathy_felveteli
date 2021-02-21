<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\StudentController;

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

Route::get('/login', [AuthController::class, 'oauth'])->name('login');
Route::get('/callback', [AuthController::class, 'callback'])->name('callback');

Route::get('/schedule', [StudentController::class, 'login']);
Route::post('/schedule', [StudentController::class, 'index']);
Route::get('/school', [StudentController::class, 'getSchoolData']);
