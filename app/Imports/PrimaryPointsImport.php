<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

use App\Models\Student;
use App\Models\primaryPoint;
use App\Models\centralExam;

HeadingRowFormatter::default('none');

class PrimaryPointsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        if(($student = Student::where('eduId', $row['Oktatási azonosító'])->first())!=NULL){

            centralExam::updateOrCreate(['student_id' =>  $student->id], [
                    'hunResult' => $row['magyar PSZ'] == NULL ? 0 : $row['magyar PSZ'],
                    'mathResult' => $row['matek PSZ'] == NULL ? 0 : $row['matek PSZ'],
            ]);

            PrimaryPoint::updateOrCreate(['student_id' =>  $student->id], [
                'lit_7' => $row['irodalom 7'],
                'lit_8h' => $row['irodalom 8F'],
                'hun_7' => $row['nyelvtan 7'],
                'hun_8h' => $row['nyelvtan 8F'],
                'math_7' => $row['matek 7'],
                'math_8h' => $row['matek 8F'],
                'his_7' => $row['töri 7'],
                'his_8h' => $row['töri 8F'],
                'flang_7' => $row['idegenNyelv 7'],
                'flang_8h' => $row['idegenNyelv 8F'],
                'phy_7' => $row['fizika 7'],
                'phy_8h' => $row['fizika 8F'],
            ]);

            return $student;
        }

        return NULL;

    }
}
