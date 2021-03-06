<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'profile_photo',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->hasMany(UserTypeList::class);
    }

    public function children(){
        return $this->belongsToMany(Student::class, 'parent_students');
    }

    public function staff(){
        return $this->hasOne(StaffMember::class);

    }

    public function classroom(){
        return $this->hasOne(Classroom::class, 'class_teacher');
    }

    public function bookings(){
        return $this->hasMany(Booking::class, 'staff_member_id');
    }

    public function blocked(){
        return $this->hasOne(BlockedUser::class);
    }
 
}