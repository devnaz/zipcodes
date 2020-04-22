<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Zip extends Eloquent
{

    protected $casts = [
        'id' => 'string',
        'zip' => 'integer',
        'city' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];

    protected $fillable = [
        'zip',
        'city',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [];
}
