<?php

namespace App\Http\Controllers;

use App\Http\Requests\getScheduleRequest;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\StudentLog;

class StudentController extends Controller
{

    public function login(){

        return view('schedule.login');

    }

    public function index(getScheduleRequest $request){
        if($request->input('sign') != NULL)
            $sign = strtoupper($request->input('sign'));
        else
            $sign = NULL;

        $student = Student::where('eduId', $request->input('eduId'))
            ->where('born', $request->input('born'))
            ->where('sign', $sign)
            ->first();

        if($student == NULL) return redirect()->route('schedule')->withErrors(['msg' => 'Adott paraméterekkel nem található tanuló!']);

        StudentLog::create([
            'eduid' => $student->eduId,
            'ip' => $request->ip(),
            'note' => $request->userAgent(),
        ]);

        return view('schedule.index', [
            'student' => $student,
        ]);
    }

}
