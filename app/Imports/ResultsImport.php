<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Student;
use App\Models\Result;

class ResultsImport implements ToModel, WithHeadingRow, WithCustomCsvSettings

{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ";"
        ];
    }

    public function model(array $row)
    {
        $student = Student::create([
            'name' => $row['name'],
            'eduId' => $row['eduid'],
            'primaryOM' => 0,
            'born' => $row['born'],
            'email' => "",
            'sign' => ($row['sign'] == NULL) ? NULL : strtoupper($row['sign']),
            'n23' => 0,
            'n25' => 0,
        ]);

        Result::create([
            'student_id' => $student->id,
            'tt0023' => $row['tt0023'],
            'tt0025' => $row['tt0025'],
        ]);


        return $student;
    }
}
