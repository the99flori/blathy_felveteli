<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\StudentsImport;
use App\Imports\KOZFELVIRapplicants;
use App\Imports\primarySchoolsImport;

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

    /*public function getSchoolData(){
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
            $response = $client->request('GET', 'https://dari.oktatas.hu/kir_int_pub_reszlet/'.$om->primaryOM);

            $name = get_string_between($response->getBody()->getContents(), '<label class="col-lg-2 col-form-label font-weight-bold">Az intézmény megnevezése:</label><div class="col-lg-8 mt-lg-2">', '</div>');
            $address = get_string_between($response->getBody()->getContents(), '<label class="col-lg-2 col-form-label font-weight-bold">Székhelye:</label><div class="col-lg-8 mt-lg-2">', '</div>');

            primarySchool::firstOrCreate([
                'om' => $om->primaryOM,
            ],
                [
                    'name' => trim($name),
                    'address' => trim($address),
                ]);
        }
    }*/

    public function importView()
    {
        return view('dashboard.import');
    }

    public function import()
    {
        switch (request()->input('importType')){
            case "KOZFELVIRapplicants":
                Excel::import(new KOZFELVIRapplicants,request()->file('file'));
                break;
            case "StudentsImport":
                Excel::import(new StudentsImport,request()->file('file'));
                break;
            case "primarySchoolsImport":
                Excel::import(new primarySchoolsImport,request()->file('file'));
                break;
        }

        // TODO: hibakezelés és visszajelzés

        return redirect()->back()->withErrors(['msg' => 'Sikeres importálás!']);
    }
}
