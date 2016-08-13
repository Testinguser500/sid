<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coupon_name', 'discount_type','discount_value', 'description','usage_limit_coupon','usage_limit_user','expire_date','exclude_sale','min_spend','max_spend','individual','products','exclude_products','category','exclude_category','user_email','is_delete','coupon_status','user_id'
    ];

   
}
