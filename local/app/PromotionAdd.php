<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionAdd extends Model
{
    protected $table = 'pramotion_promo_add';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['promotion_name','campaign_id','product_promote',
                           'destination_cat','adcontent_title','adcontent_discrip'];

   
}