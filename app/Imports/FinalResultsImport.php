<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

use App\Models\Student;
use App\Models\Result;


HeadingRowFormatter::default('none');

class FinalResultsImport implements ToModel, WithHeadingRow

{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {

        if(($student = Student::where('eduId', $row['Oktatási azonosító'])->first())!=NULL){
            $result = Result::updateOrCreate(
                ['student_id' => $student->id]
            );

            if(isset($row['Azon tanulmányi terület kódszáma, amelyre a jelentkező felvételt nyert'])) $result->final = $row['Azon tanulmányi terület kódszáma, amelyre a jelentkező felvételt nyert'];

            $result->save();

            return $student;
        }

        return NULL;
    }
}
