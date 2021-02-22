<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\Models\Student;
use App\Models\Meeting;
use App\Models\primarySchool;

class StudentController extends Controller
{

    public function login(){

        return '';

    }

    public function index(Request $request){
        $meeting = Meeting::select('*')
            ->join('students', 'students.id', '=', 'meetings.student_id')
            ->where('students.eduId', $request->input('eduId'))
            ->where('students.sign', $request->input('sign'))
            ->get();


        return view('schedule.info');
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

            $fullstring = $response->getBody()->getContents();
            $parsed = get_string_between($fullstring, 'A(z)', ') köznevelési');
            $pieces = explode("(", $parsed);

            primarySchool::firstOrCreate([
                'om' => $om->primaryOM,
            ],
                [
                    'name' => trim($pieces[0]),
                    'address' => trim($pieces[1]),
                ]);

            //dd(trim($pieces[0]));

        }


    }

}
