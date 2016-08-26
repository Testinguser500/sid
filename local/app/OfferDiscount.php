<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class OfferDiscount extends Authenticatable
{
    protected $table='offer_discount';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offer_id','min_qty','max_qty','adjustment_type','adjustment_value'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
}
