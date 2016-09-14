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
        'name', 
        'email', 
        'password', 
        'role_id', 
        'is_active', 
        'photo_id'
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


    // Muttator for crypt password before Insert
    /*public function setPasswordAttribute($password){
        if( !empty($password) ){
            $this->attributes['password'] = bcrypt($password);
        }
    }*/


    // Check if User has role "Administrator" or "Author". Than allow aproach to admin panel.
    public function isAdmin(){
        if( $this->role->name == 'Author' || $this->role->name == 'Administrator' ){
            return true;
        }
            else{
                return false;
            }
    }


    // Set Many to Many Relationship 
    public function posts(){
        return $this->hasMany('App\Post');
    }

    // Gravatar
    public function getGravatarAttribute(){
        $hash = md5( strtolower(trim($this->attributes['email'])) . "?d=mm");
        return "http://www.gravatar.com/avatar/".$hash;
    }
}
