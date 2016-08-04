<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDataType extends Model
{
    protected $table = 'product_data_type';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data_type'
    ];

   
}
