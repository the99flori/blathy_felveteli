<?php

namespace App\Imports;

use App\Models\primarySchool;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class primarySchoolsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $primarySchool = primarySchool::updateOrCreate(['om' => $row['OM azonosító']],[
            'name' => $row['Intézmény megnevezése'],
            'address' => $row['Intézmény székhelyének irányítószáma']." ".$row['Intézmény székhelyének települése'].", ".$row['Intézmény székhelyének pontos címe'],
        ]);

        return $primarySchool;
    }
}
