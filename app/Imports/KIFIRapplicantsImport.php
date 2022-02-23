<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

use App\Models\Student;
use App\Models\Panel;
use App\Models\Meeting;

HeadingRowFormatter::default('none');

class KIFIRapplicantsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        return Student::updateOrCreate(['eduId' => $row['Oktatási azonosító']],[
            'name' => $row['Név'],
            'primaryOM' => $row['Általános iskola OM kódja'],
            'bornPlace' => $row['Születési hely'],
            'bornDate' => Date::excelToDateTimeObject($row['Születési dátum']),
            //'email' => ($row['email'] == NULL) ? NULL : $row['email'],
            'sign' => ($row['Jelige'] == NULL) ? NULL : mb_strtoupper($row['Jelige']),
            'n23' => ($row['001/0023'] == NULL) ? 0 : 1,
            'n25' => ($row['001/0025'] == NULL) ? 0 : 1,
        ]);

    }
}
