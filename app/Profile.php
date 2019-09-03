<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //relación de uno a uno
    public function user(){
        return $this->belongsTo('App\User');
    }

    //solo permitir insertar estos campos
    protected $fillable = ['user_id','avatar','youtube','facebook','about'];
}
