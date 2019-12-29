<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
    protected $table = 'urls';

    protected $fillable = [
        'url'
    ];

    protected $hidden = [
        'visits',
        'hash'
    ];

    protected $casts = [
        'visits' => 'integer'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'hash';
    }
}
