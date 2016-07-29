<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
	protected $table = 'affiliate';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'store_id','category_id','fees','user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
