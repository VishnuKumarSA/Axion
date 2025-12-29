<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Enterprise extends Model
{
    protected $fillable = [
        'uuid',
        'slug',
        'name',
        'code',
        'email',
        'phone',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($enterprise) {

            // UUID
            $enterprise->uuid = $enterprise->uuid ?? (string) Str::uuid();

            // SLUG
            if (empty($enterprise->slug)) {
                $slug = Str::slug($enterprise->name);
                $count = self::where('slug', 'LIKE', "{$slug}%")->count();
                $enterprise->slug = $count ? "{$slug}-{$count}" : $slug;
            }
        });
    }
}
