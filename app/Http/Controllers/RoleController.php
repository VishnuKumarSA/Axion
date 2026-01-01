<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * List roles (tenant scoped)
     */
    public function index()
    {
        $tenantId = auth()->user()->enterprise_id;

        return response()->json(
            Role::where('enterprise_id', $tenantId)->get(),
            200
        );
    }

    /**
     * Create role (tenant scoped)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $tenantId = auth()->user()->enterprise_id;

        $role = Role::create([
            'enterprise_id' => $tenantId,
            'name'          => $request->name
        ]);

        return response()->json([
            'message' => 'Role created successfully',
            'role'    => $role
        ], 201);
    }

    /**
     * Update role (tenant scoped)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50'
        ]);

        $tenantId = auth()->user()->enterprise_id;

        $role = Role::where('enterprise_id', $tenantId)
                    ->where('id', $id)
                    ->firstOrFail();

        $role->update([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Role updated successfully',
            'role'    => $role
        ], 200);
    }

    /**
     * Delete role (tenant scoped)
     */
    public function destroy($id)
    {
        $tenantId = auth()->user()->enterprise_id;

        $role = Role::where('enterprise_id', $tenantId)
                    ->where('id', $id)
                    ->firstOrFail();

        $role->delete();

        return response()->json([
            'message' => 'Role deleted successfully'
        ], 200);
    }
}
