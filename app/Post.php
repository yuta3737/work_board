<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model

{
    //
    
    protected $fillable = [
    'title',
    'user_id',
    'image_path',
];

    
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }    
    
}
