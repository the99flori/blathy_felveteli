<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function(){
    return redirect('/schedule');
});

Route::get('/login', [AuthController::class, 'oauth'])->name('login');
Route::get('/logout', function (){
    Auth::logout();
    return 'KILÉPVE!';
});
Route::get('/callback', [AuthController::class, 'callback'])->name('callback');

Route::get('/schedule', [StudentController::class, 'login'])->name('schedule');
Route::post('/schedule', [StudentController::class, 'index'])->name('schedule.index');
Route::get('/school', [StudentController::class, 'getSchoolData'])->middleware('auth');

Route::get('/import', [StudentController::class, 'importView'])->middleware('auth');
Route::post('/import', [StudentController::class, 'import'])->name('import')->middleware('auth');
