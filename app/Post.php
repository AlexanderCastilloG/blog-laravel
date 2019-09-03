<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //import method table migrate post

class Post extends Model
{
    use SoftDeletes;// use import method table migrate post

    // //atributos de la tabla a utilizar
    protected $fillable = ['title','content','category_id','featured','slug'];

    //Para generar el link para la imagen en nuestra aplicacion
    public function getFeaturedAttribute($featured){
        return asset($featured);
    }

    //colocar un campo con el nombre deleted_at usando el metodo softDeletes
    protected $dates =['deleted_at'];

    public function category() {
        
        return $this->BelongsTo('App\Category');
    }

    //tags , posts === tag, post === post_tag;
    public function tags(){
        return $this->BelongsToMany('App\Tag');
    }

    public function user(){
        return $this->BelongsTo('App\User');
    }
}
