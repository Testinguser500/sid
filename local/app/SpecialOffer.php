<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class SpecialOffer extends Authenticatable
{
    protected $table='offers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offer_name','method','quantity_based_on','condition_match','start_date','end_date','apply_to','product_list','customers','category_list','role_list','customer_list','amount_purchase','products_adujst','specific_category','specific_product','amount_adjust','adjustment_type','adjustment_value','is_delete'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
}
