<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;


class PermissionController extends Controller
{
     public function createPermission(Request $request)
    {
        $request->validate([
            'key' => 'required|string|unique:permissions,key'
        ]);

        $permission = Permission::create([
            'key' => $request->key
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permission created successfully',
            'data'    => $permission
        ], 201);
    }
}
