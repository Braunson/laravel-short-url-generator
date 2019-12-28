<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
    protected $fillable = [
        'url'
    ];

    protected $hidden = [
        'visits',
        'hash'
    ];
}
