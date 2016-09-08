<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'category_id',
    	'user_id',
    	'photo_id',
    	'title',
    	'body'
    ];

    // Belongs to - Relationship 1:1
    public function user(){
    	return $this->belongsTo('App\User');
    }

    // Relationship with Photo
    public function photo(){
    	return $this->belongsTo('App\Photo');
    }

    // Relationship with Category 
    public function category(){
    	return $this->belongsTo('App\Category');
    }


}
