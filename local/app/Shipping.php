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
        'name', 'mobile','address','role','country','state','city','status','user_id'
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
