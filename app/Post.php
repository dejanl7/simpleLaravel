<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source'    => 'title',
                'onUpdate'  => true,
            ]
        ];
    }

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

    // Relation with Comments
    public function comments(){
        return $this->hasMany('App\Comment');
    }




}
