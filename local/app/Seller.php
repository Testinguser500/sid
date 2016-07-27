<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends Authenticatable
{
    protected $table = 'sellers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','gender','address','role','image','mobile','company_name','company_pan_no','company_tin_no','company_address','menu_assign','status'
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
