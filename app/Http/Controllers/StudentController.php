<?php

namespace App\Http\Controllers;

use App\Http\Requests\getScheduleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Student;
use App\Models\StudentLog;
use App\Models\studentFile;
use App\Models\Meeting;


class StudentController extends Controller
{

    public function schedule_login(){
        $updated_at = (($update = Meeting::orderBy('updated_at','DESC')->first()) == null ? "nincs adat" : date('Y.m.d. H:i', strtotime($update->updated_at)));

        return view('schedule.login', [
            'updated_at' => $updated_at,
        ]);
    }

    public function schedule_login_post(getScheduleRequest $request){

        if($request->input('sign') != NULL)
            $sign = strtoupper($request->input('sign'));
        else
            $sign = NULL;

        $student = Student::where('eduId', $request->input('eduId'))
            ->where('bornDate', $request->input('born'))
            ->where('sign', $sign)
            ->first();

        if($student == NULL) return redirect()->route('schedule')->withErrors(['msg' => 'Adott paraméterekkel nem található tanuló!']);

        Auth::guard('student')->loginUsingId($student->id);
        $request->session()->regenerate();

        StudentLog::create([
            'eduid' => $student->eduId,
            'ip' => $request->ip(),
            'note' => $request->userAgent(),
        ]);

        return redirect()->route('schedule.index');
    }

    public function schedule_index(){
        If(!(Auth::guard('student')->check())) return redirect()->route('schedule');

        $student = Student::find(Auth::guard('student')->id());

        return view('schedule.index', [
            'student' => $student,
        ]);
    }

    public function apply_login(){
        $updated_at = (($update = Student::orderBy('updated_at','DESC')->first()) == null ? "nincs adat" : date('Y.m.d. H:i', strtotime($update->updated_at)));

        return view('apply.login', [
            'updated_at' => $updated_at,
        ]);

    }

    public function apply_login_post(getScheduleRequest $request){

        $student = Student::where('eduId', $request->input('eduId'))
            ->where('bornDate', $request->input('born'))
            ->first();

        if($student == NULL) return redirect()->route('apply')->withErrors(['msg' => 'Adott paraméterekkel nem található tanuló!']);

        Auth::guard('student')->loginUsingId($student->id);
        $request->session()->regenerate();

        StudentLog::create([
            'eduid' => $student->eduId,
            'ip' => $request->ip(),
            'note' => $request->userAgent(),
        ]);

        return redirect()->route('apply.index');
    }

    public function apply_index(){
        If(!(Auth::guard('student')->check())) return redirect()->route('apply');

        $student = Student::find(Auth::guard('student')->id());
        $file = studentFile::where('student_id', $student->id)->where('type', 'special_decree')->first();

        return view('apply.index', [
            'student' => $student,
            'file' => $file,
        ]);

    }

    public function getFile($id){
        $file = studentFile::where('id', $id)->first();
        $student = Student::where('id', $file->student_id)->first();;
        if(Auth::check() || $file->student_id == Auth::guard('student')->id()) return Storage::download($file->path);
        abort(403);
    }

}
