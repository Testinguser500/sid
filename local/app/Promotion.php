<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotion_settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ad_type','field_name','field_value','status'];

   
}