<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //para que solo inserte este dato
    protected $fillable = ['tag'];

    public function posts(){

        return $this->belongsToMany('App\Post');

    }
}
