<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticContent extends Model
{
    protected $table = 'static_content';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','alias', 'short_description', 'description'
    ];

    
}
