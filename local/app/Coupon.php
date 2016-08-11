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
        'coupon_name', 'discount_type','discount_value', 'description','usage_limit','expire_date','exclude_sale','min_amount','is_delete','coupon_status','user_id'
    ];

   
}
