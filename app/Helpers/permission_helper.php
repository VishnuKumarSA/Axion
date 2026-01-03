<?php

use App\Models\User;

if (!function_exists('hasPermission')) {
    function hasPermission(User $user, string $permissionKey): bool
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
        
        return $user->roles()
            ->whereHas('permissions', function ($q) use ($permissionKey) {
                $q->where('key', $permissionKey);
            })
            ->exists();
    }
}
