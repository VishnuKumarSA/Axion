<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnterpriseSetting extends Model
{
    protected $fillable = [
        'enterprise_id',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array'
    ];
}
