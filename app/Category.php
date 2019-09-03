<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //relationship one a many, but a category can have many posts
    // Add One to many relationship ->agregar una relación de uno a muchos
    public function posts(){

        return $this->hasMany('App\Post');

        //listings.user_id
        //esta buscando en la tabla Category una columna  _id

    }
}
