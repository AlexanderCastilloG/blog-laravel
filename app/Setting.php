<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //para ingresar solo estos campos
    protected $fillable = ['site_name','contact_number','contact_email', 'address'];
}
