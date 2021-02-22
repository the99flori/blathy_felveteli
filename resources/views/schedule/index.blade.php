Tanuló neve: {{$student->name}}</br>
Oktatási azonosítója: {{$student->eduId}}</br>
Születési ideje: {{$student->born}}</br>
Általános iskolájának OM azonosítója: {{$student->primarySchool->om}}</br>
Általános iskolájának neve: {{$student->primarySchool->name}}</br>
Általános iskolájának címe: {{$student->primarySchool->address}}</br>
Szóbeli időpontja: {{$student->meeting->datetime}}</br>
Szóbeli terme: {{$student->meeting->panel->room}}
