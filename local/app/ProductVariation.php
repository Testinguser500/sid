<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $table = 'product_variation';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vari_comb_value_ids','product_id','vari_sku','vari_price','vari_sale_price','vari_stock'
    ];

   
}
