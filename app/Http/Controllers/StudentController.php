<?php

namespace App\Http\Controllers;

use App\Http\Requests\getScheduleRequest;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;

use App\Models\Student;
use App\Models\primarySchool;
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
        return view('import');
    }

    public function import()
    {
        Excel::import(new StudentsImport,request()->file('file'));

        return redirect()->back();
    }

}
