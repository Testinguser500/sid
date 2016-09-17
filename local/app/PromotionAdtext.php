<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionAdtext extends Model
{
    protected $table = 'promotion_adtext';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['compaign_name','ad_type','ad_placement','view_price','schedule','start_date','end_date'];

   
}

