<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
Route::get('/login/local', [AuthController::class, 'login'])->name('login.local');
Route::post('/login/local', [AuthController::class, 'loginPost']);
Route::get('/logout', function (Request $request){
    // TODO: Maybe should clear token values?
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return 'KILÉPVE!';
})->name('logout');
Route::get('/callback', [AuthController::class, 'callback'])->name('callback');

Route::get('/schedule', [StudentController::class, 'login'])->name('schedule');
Route::post('/schedule', [StudentController::class, 'index'])->name('schedule.index');


Route::get('/dashboard', function (){
    return view('private.index');
})->name('dashboard')->middleware('auth');

Route::get('/school', [StudentController::class, 'getSchoolData'])->name('omschools')->middleware('auth');

Route::get('/import', [StudentController::class, 'importView'])->middleware('auth');
Route::post('/import', [StudentController::class, 'import'])->name('import')->middleware('auth');
