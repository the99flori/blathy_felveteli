<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Artisan;

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
    return redirect('/result');
})->name('home');

/* Authentication */
Route::get('/login', [AuthController::class, 'oauth'])->name('login');
Route::get('/login/local', [AuthController::class, 'login'])->name('login.local');
Route::post('/login/local', [AuthController::class, 'loginPost']);
Route::get('/callback', [AuthController::class, 'callback'])->name('callback');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/* StudentController */
//Route::get('/apply/login', [StudentController::class, 'apply_login'])->name('apply');
//Route::post('/apply', [StudentController::class, 'apply_login_post'])->name('apply.login');

//Route::get('/apply', [StudentController::class, 'apply_index'])->name('apply.index');

//Route::get('/student/file/{id}', [StudentController::class, 'getFile'])->name('studentfile');

//Route::get('/schedule/login', [StudentController::class, 'schedule_login'])->name('schedule');
//Route::post('/schedule', [StudentController::class, 'schedule_login_post'])->name('schedule.login');

//Route::get('/schedule', [StudentController::class, 'schedule_index'])->name('schedule.index');

Route::get('/result/login', [StudentController::class, 'result_login'])->name('result');
Route::post('/result', [StudentController::class, 'result_login_post'])->name('result.login');

Route::get('/result', [StudentController::class, 'result_index'])->name('result.index');

/* AdminController */
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {

    Route::get('/', [AdminController::class, 'dashboardIndex'])->name('index');
    Route::get('/log', [AdminController::class, 'studentlog'])->name('studentlog');
    Route::get('/mail/centralexam', [AdminController::class, 'sendEmailCentralExamScheduled']);

    Route::prefix('import')->name('import.')->group(function () {
        Route::get('/', [AdminController::class, 'importView'])->name('get');
        Route::post('/', [AdminController::class, 'import'])->name('post');
    });

    Route::get('/applies', [AdminController::class, 'appliesIndex'])->name('applies');

    Route::prefix('panels')->name('panels.')->group(function () {
        Route::get('/', [AdminController::class, 'panelsList'])->name('list');
        Route::get('/{id}', [AdminController::class, 'panelsIndex'])->name('index');
    });

    Route::prefix('student')->name('student.')->group(function () {

        Route::post('/fileupload', [AdminController::class, 'postStudentFileupload'])->name('fileupload');
        Route::get('/filedelete/{id}', [AdminController::class, 'deleteStudentFile'])->name('filedelete');

        Route::prefix('oralexam')->name('oralexam.')->group(function () {
            Route::get('/{id}', [AdminController::class, 'getStudentOralExamIndex'])->name('index');
            Route::post('/change', [AdminController::class, 'getStudentOralExamDatetimeChange'])->name('change');
        });

        Route::prefix('centralexam')->name('centralexam.')->group(function () {
            Route::get('/{id}', [AdminController::class, 'getStudentCentralExamIndex'])->name('index');
        });
    });

    /* Maintenance mode form URL */
    Route::prefix('app')->group(function () {
        Route::get('/up', function (){
            Artisan::call('up');
            return "UP!";
        });
        Route::get('/down/{secret}', function ($secret){
            Artisan::call('down', ['--secret' => $secret]);
            return "DOWN! (".$secret.")";
        });
    });
});



