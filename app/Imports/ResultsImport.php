<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

use App\Models\Student;
use App\Models\Result;


HeadingRowFormatter::default('none');

class ResultsImport implements ToModel, WithHeadingRow

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

            $result->tt0023 = NULL;
            $result->tt0025 = NULL;

            if(($row['szóbeli PSZ'] == "-" && $row["Felvételi összpont SZÁMÍTOTT"] == "0")){
                $result->sumpoint = "NORAL";
            }
            elseif ($row["Felvételi összpont SZÁMÍTOTT"] != "") {
                $result->sumpoint = str_replace('.', ',', $row["Felvételi összpont SZÁMÍTOTT"]);

                if($row["N23"] != "") $result->tt0023 = $row["N23"];
                if($row["N25"] != "") $result->tt0025 = $row["N25"];
            }

            $result->save();

            return $student;
        }

        return NULL;
    }
}
