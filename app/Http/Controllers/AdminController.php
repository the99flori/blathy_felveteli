<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Panel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ImportRequest;
use App\Http\Requests\StudentUploadRequest;


use App\Imports\StudentsImport;
use App\Imports\KOZFELVIRapplicants;
use App\Imports\primarySchoolsImport;
use App\Imports\CentralExamTapaScheduleTableImport;
use App\Imports\OralExamTapaScheduleImport;
use App\Imports\KIFIRapplicantsImport;
use App\Imports\PrimaryPointsImport;

use App\Models\Student;
use App\Models\StudentLog;
use App\Models\studentFile;

use App\Mail\CentralExamScheduled;

class AdminController extends Controller
{

    public function dashboardIndex(){
        $all = Student::select('eduid')->groupBy('eduid')->get()->count();
        $success = StudentLog::distinct()->select('eduid')->groupBy('eduid')->get()->count();
        $mypanel = Panel::find(Auth::user()->panels->first()->id);

        return view('dashboard.index', [
            'success' => $success,
            'all' => $all,
            'mypanel' => $mypanel,
        ]);
    }

    public function getStudentOralExamIndex($id)
    {
        $student = Student::where('id', $id)->first();


        return view('dashboard.student.oralexam.index', [
            'student' => $student,
        ]);

    }

    public function getStudentOralExamDatetimeChange(Request $request){
        $student = Student::find($request->input('studentid'));

        $student->meeting->datetime = $request->input('datetime');
        $panel = Panel::where('room', $request->input('room'))->first();

        if($panel == NULL) return redirect()->route('dashboard.student.oralexam.index', ['id' => $student->id])->withErrors(['msg' => 'Nem található a bizottság!']);

        $student->meeting->panel_id = $panel->id;
        $student->meeting->save();

        return redirect()->route('dashboard.student.oralexam.index', ['id' => $student->id])->withErrors(['info' => 'Sikeres módosítás!']);
    }

    public function importView()
    {
        return view('dashboard.import');
    }

    public function import(ImportRequest $request)
    {
        switch ($request->input('importType')){
            case "OralExamTapaSchedule":
                Excel::import(new OralExamTapaScheduleImport,$request->file('file'));
                break;
            case "CentralExamTapaScheduleTable":
                Excel::import(new CentralExamTapaScheduleTableImport,$request->file('file'));
                break;
            case "KOZFELVIRapplicants":
                Excel::import(new KOZFELVIRapplicants,$request->file('file'));
                break;
                case "KIFIRapplicantsImport":
                Excel::import(new KIFIRapplicantsImport,$request->file('file'));
                break;
            case "StudentsImport":
                Excel::import(new StudentsImport,$request->file('file'));
                break;
            case "primarySchoolsImport":
                Excel::import(new primarySchoolsImport,$request->file('file'));
                break;
            case "PrimaryPointsImport":
                Excel::import(new PrimaryPointsImport,$request->file('file'));
                break;
        }

        // TODO: hibakezelés és visszajelzés

        return redirect()->back()->withErrors(['msg' => 'Sikeres importálás!']);
    }

    public function sendEmailConfirm($email)
    {
        return view('dashboard.import');
    }

    public function getStudentCentralExamIndex($id)
    {
        $student = Student::where('id', $id)->first();
        $files = studentFile::select('id', 'type')->where('student_id', $id)->get();


        return view('dashboard.student.centralexam.index', [
            'student' => $student,
            'files' => $files,
        ]);

    }

    public function appliesIndex(){
        $students = Student::all();

        return view('dashboard.applies', [
            'students' => $students,

        ]);
    }

    public function postStudentFileupload(StudentUploadRequest $request)
    {
        $student = Student::find($request->studentid);
        $file = $request->file('file');
        switch ($request->input('type')){
            case "special_decree":
                studentFile::create([
                    'student_id' => $student->id,
                    'type' => 'special_decree',
                    'path' => $file->storeAs('students_files', $student->eduId.'_specvizsga_hatarozat.'.$file->extension()),
                ]);
                break;
        }

        // TODO: hibakezelés és visszajelzés

        return redirect()->back()->withErrors(['msg' => 'Sikeres feltöltés!']);
    }

    public function deleteStudentFile($id){
        $file = studentFile::find($id);
        studentFile::destroy($id);
        Storage::delete($file->path);
        return back();
    }

    public function sendEmailCentralExamScheduled(){

        $students = Student::all();

        foreach ($students as $student) {
            //Mail::to($student->email)->later(now()->addMinutes(1),new CentralExamScheduled);
        }

        //Mail::to(['demecs.florian@blathy.info', 'harangozo.zsolt@blathy.info'])->later(now()->addMinutes(1),new CentralExamScheduled);

        return 'SORBA ÁLLÍTVA!';
    }

    public function studentlog(){
        $logs = DB::select(DB::raw('SELECT students.*, COUNT(student_logs.eduid) AS count FROM student_logs INNER JOIN students ON students.eduId=student_logs.eduid GROUP BY student_logs.eduid'));

        return view('dashboard.studentlog', [
            'logs' => $logs,
        ]);
    }

    public function panelsList(){
        $panels = Panel::orderBy('room')->get();

        return view('dashboard.panels.list', [
            'panels' => $panels,

        ]);
    }

    public function panelsIndex($id)
    {
        $panel = Panel::find($id);
        $meetings = Meeting::where('panel_id', $id)->get();


        return view('dashboard.panels.index', [
            'meetings' => $meetings,
            'panel' => $panel,
        ]);

    }


}
