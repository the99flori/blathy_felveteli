<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Student;
use App\Models\primaryPoint;
use App\Models\centralExam;
use App\Models\Panel;
use App\Models\Meeting;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $student = Student::create([
            'name' => $row['name'],
            'eduId' => $row['eduid'],
            'primaryOM' => $row['om'],
            'born' => $row['born'],
            'email' => $row['email'],
            'sign' => ($row['sign'] == NULL) ? NULL : strtoupper($row['sign']),
            'n23' => ($row['n23'] == NULL) ? 0 : 1,
            'n25' => ($row['n25'] == NULL) ? 0 : 1,
        ]);

        primaryPoint::create([
            'student_id' => $student->id,
            'lit_7' => $row['lit_7'],
            'lit_8h' => $row['lit_8h'],
            'hun_7' => $row['hun_7'],
            'hun_8h' => $row['hun_8h'],
            'math_7' => $row['math_7'],
            'math_8h' => $row['math_8h'],
            'his_7' => $row['his_7'],
            'his_8h' => $row['his_8h'],
            'flang_7' => $row['flang_7'],
            'flang_8h' => $row['flang_8h'],
            'phy_7' => $row['phy_7'],
            'phy_8h' => $row['phy_8h'],
        ]);

        centralExam::create([
            'student_id' => $student->id,
            'hun' => $row['hun_exam'],
            'math' => $row['math_exam'],
        ]);

        $panel = Panel::firstOrCreate([
                'room' => $row['room'],
            ]);

        Meeting::create([
            'student_id' => $student->id,
            'panel_id' => $panel->id,
            'datetime' => $row['datetime'],
        ]);

        return $student;
    }
}
