<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class primarySchool extends Model
{
    use HasFactory;

    protected $fillable = ['om', 'name', 'address'];

    public function students()
    {
        return $this->hasMany(Student::class, 'primaryOM', 'om');
    }

}
