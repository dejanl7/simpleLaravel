<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $uploads = '/images/';


    // Fillable
    protected $fillable = [
    	'file'
    ];

    // Creating Accessor 
    public function getFileAttribute($photo){
    	return $this->uploads . $photo;
    }

    


}
