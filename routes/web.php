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
    if (Auth::guest()) return redirect('/login');
    else return redirect('/school');
});

Route::get('/login', [AuthController::class, 'oauth'])->name('login');
Route::get('/logout', function (){
    Auth::logout();
    return 'KILÉPVE';
});
Route::get('/callback', [AuthController::class, 'callback'])->name('callback');

Route::get('/schedule', [StudentController::class, 'login']);
Route::post('/schedule', [StudentController::class, 'index']);
Route::get('/school', [StudentController::class, 'getSchoolData'])->middleware('auth');;
