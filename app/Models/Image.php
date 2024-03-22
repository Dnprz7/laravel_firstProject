<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    //RELACION UNO A MUCHOS
    public function comments()
    {
        return $this->hasMany(Comment::class);
        // return $this->hasMany('App\Comment');
    }

    //RELACION UNO A MUCHOS
    public function likes()
    {
        return $this->hasMany(Like::class);
        // return $this->hasMany('App\Like');
    }

    //RELACION MUCHOS A UNO
    public function user()
    {
        return $this->belongsTo(Like::class, 'user_id');
        // return $this->belongsTo('App\User, 'user_id');
    }

}
