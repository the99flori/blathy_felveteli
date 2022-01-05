<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

use App\Models\Student;
use App\Models\centralExam;

HeadingRowFormatter::default('none');

class KOZFELVIRapplicants implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $student = Student::updateOrCreate(['eduId' => $row['Tanuló oktatási azonosító száma']],[
            'name' => $row['Tanuló neve'],
            'primaryOM' => $row['A tanuló általános iskolájának OM kódja'],
            'bornPlace' => $row['Tanuló születési helye'],
            'bornDate' => date_create_from_format('Y. m. j.', $row['Tanuló születési dátuma']),
            'email' => $row['Értesítési e-mail címe'],
        ]);

        centralExam::updateOrCreate(['student_id' => $student->id],[
            'isHun' => ($row['9 Évfolyamos általános/magyar nyelv'] == "Igen"),
            'isMath' => ($row['9 Évfolyamos általános/matematika'] == "Igen"),
            'isSpecial' => ($row['Egyéb speciális igény'] == "Igen"),
        ]);

        //if($student->wasRecentlyCreated || $student->wasChanged('email')) sendEmailConfirm($student->email);


        return $student;
    }
}
