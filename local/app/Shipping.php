<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
	protected $table = 'shipp_address';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ship_fname','ship_lname', 'ship_mobile','ship_address','role','ship_country','ship_state','ship_city','ship_status','user_id'
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
