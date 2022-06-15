<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'profile_photo',
    ];
    public function classrooms(){
        return $this->belongsToMany(Classroom::class, 'classroom_students');
    }

    public function parents(){
        return $this->belongsToMany(User::class, 'parent_students');
    }
}
