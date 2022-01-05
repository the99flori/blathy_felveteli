<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

use App\Models\Student;
use App\Models\centralExam;

use App\Http\Controllers\AdminController;

HeadingRowFormatter::default('none');

class CentralExamTapaScheduleTableImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $student = Student::where('eduId', $row['Oktatási azonositó'])->first();

        if($row['Vizsgatárgy']=='Magyar nyelv'){
            centralExam::where('student_id', $student->id)->update([
                'hunRoom' => ($row['Terem azonosítója']),
            ]);
        }

        if($row['Vizsgatárgy']=='Matematika'){
            centralExam::where('student_id', $student->id)->update([
                'mathRoom' => ($row['Terem azonosítója']),
            ]);
        }

        return $student;
    }
}
