<?php

namespace App;

//use App\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // Define Database Tables Relationship with class "Role"
    public function role(){
        return $this->belongsTo('App\Role');
    }

    // Relationship with class "Photo"
    public function photo(){
        return $this->belongsTo('App\Photo');
    }
}
