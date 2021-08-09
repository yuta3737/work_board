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

public function getPaginateByLimit(int $limit_count = 10)
{
// updated_atで降順に並べたあと、limitで件数制限をかける
return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
}




    public function comments()
    {
        return $this->hasMany('App\Comment');
    }    
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
