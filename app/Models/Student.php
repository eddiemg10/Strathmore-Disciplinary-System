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
        'classroom_id',
    ];
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }

    public function parents(){
        return $this->belongsToMany(User::class, 'parent_students');
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
