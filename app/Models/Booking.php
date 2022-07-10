<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function teacher(){
        return $this->belongsTo(User::class, 'staff_member_id');
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
}
