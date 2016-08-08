<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pro_name','pro_des','pro_short_des','pro_feature_des','seller_id','pro_category_id','brand_id','product_tags','price','no_stock','pro_datatype_id','pro_opt_name_id','pro_opt_values_id','sku','date_from','date_to','video','weight','length','width','height','meta_title','meta_description','meta_keywords','is_delete','status'
    ];

   
}
