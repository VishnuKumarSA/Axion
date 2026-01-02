<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function assignPermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id'
        ]);

        $role = Role::where(
            'enterprise_id',
            auth()->user()->enterprise_id
        )->where(
                'id',
                $request->role_id
            )->firstOrFail();

        // Attach permissions (sync = replace old)
        $role->permissions()->sync($request->permission_ids);

        return response()->json([
            'success' => true,
            'message' => 'Permissions assigned to role successfully'
        ], 200);
    }
}
