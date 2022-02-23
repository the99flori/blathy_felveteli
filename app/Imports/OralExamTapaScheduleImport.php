<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use App\Models\Student;
use App\Models\Panel;
use App\Models\Meeting;

HeadingRowFormatter::default('none');

class OralExamTapaScheduleImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        if(($student = Student::where('eduId', $row['Oktatási azonosító'])->first())!=NULL){
            if(isset($row['Szóbeli bizottság'])){
                $panel = Panel::updateOrCreate(
                    ['room' =>  $row['Szóbeli bizottság']],
                );
            }

            $meeting = Meeting::updateOrCreate(
                ['student_id' => $student->id]
            );

            if(isset($row['Szóbeli dátum']) && isset($row['Szóbeli idősáv'])){
                $date = Date::excelToDateTimeObject($row['Szóbeli dátum']);
                $time = Date::excelToDateTimeObject($row['Szóbeli idősáv']);
                $meeting->datetime = $date->setTime($time->format('H'), $time->format('i'), $time->format('s'));
                $meeting->panel_id = $panel->id;
            }

            if(isset($row['Szóbelizik-e']) && $row['Szóbelizik-e']=='NemMIN') $meeting->note = $row['Szóbelizik-e'];
            elseif(isset($row['Szóbelizik-e']) && $row['Szóbelizik-e']=='NemMAX') $meeting->note = $row['Szóbelizik-e'];

            $meeting->save();

            return $student;
        }

        return NULL;

    }
}
