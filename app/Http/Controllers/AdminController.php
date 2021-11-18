<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\StudentsImport;

use App\Models\primarySchool;
use App\Models\Student;
use App\Models\StudentLog;

class AdminController extends Controller
{

    public function dashboardIndex(){
        $all = Student::select('eduid')->groupBy('eduid')->get()->count();
        $success = StudentLog::distinct()->select('eduid')->groupBy('eduid')->get()->count();

        return view('dashboard.index', [
            'success' => $success,
            'all' => $all,
        ]);
    }

    public function getStudentOralExamInfoIndex(){

        return view('dashboard.student.oralexam.index');
    }

    public function getStudentOralExamInfoRequest(Request $request){
        $student = Student::where('eduId', $request->input('eduid'))->first();

        if($student == NULL) return redirect()->route('dashboard.student.oralexam.index')->withErrors(['msg' => 'Nem található tanuló ilyen oktatási azonosítóval!']);

        return redirect()->route('dashboard.student.oralexam.info', ['id' => $student->id]);
    }

    public function getStudentOralExamInfo($id){
        $student = Student::where('id', $id)->first();

        return view('dashboard.student.oralexam.info', [
            'student' => $student,
        ]);
    }

    public function getSchoolData(){
        function get_string_between($string, $start, $end){
            $string = ' ' . $string;
            $ini = strpos($string, $start);
            if ($ini == 0) return '';
            $ini += strlen($start);
            $len = strpos($string, $end, $ini) - $ini;
            return substr($string, $ini, $len);
        }

        $client = new Client();

        foreach (Student::select('primaryOM')->get() as $om){
            $response = $client->request('GET', 'https://www.oktatas.hu/kozneveles/intezmenykereso/koznevelesi_intezmenykereso/!DARI_Intezmenykereso/oh.php?id=kir_int_mod&param='.$om->primaryOM);

            $parsed = get_string_between($response->getBody()->getContents(), 'A(z)', ') köznevelési');
            $pieces = explode("(", $parsed);

            primarySchool::firstOrCreate([
                'om' => $om->primaryOM,
            ],
                [
                    'name' => trim($pieces[0]),
                    'address' => trim($pieces[1]),
                ]);
        }
    }

    public function importView()
    {
        return view('dashboard.import');
    }

    public function import()
    {
        Excel::import(new StudentsImport,request()->file('file'));
        // TODO: hibakezelés és visszajelzés

        return redirect()->back();
    }
}
