<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function primarySchool()
    {
        return $this->belongsTo(primarySchool::class, 'primaryOM', 'om');
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'id', 'student_id');
    }

    public function primaryPoint()
    {
        return $this->hasOne(primaryPoint::class);
    }

    public function centralExam()
    {
        return $this->hasOne(centralExam::class);
    }

    public function oralPoint()
    {
        return $this->hasOne(oralPoint::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

}
