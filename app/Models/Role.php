<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'enterprise_id',
        'name'
    ];

    // Role belongs to one tenant
    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    // Role has many users (via pivot)
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }
}
