<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userProfile()
    {
        $user_details = auth()->user();
        return response()->json([
            'details' => $user_details
        ]);
    }

    public function assignRole(Request $request)
    {
        if (!hasPermission(auth()->user(), 'assign_role')) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id'
        ]);

        if (auth()->id() == $request->user_id) {
            return response()->json([
                'message' => 'You cannot change your own role'
            ], 403);
        }

        $user = User::where('enterprise_id', auth()->user()->enterprise_id)
            ->where('id', $request->user_id)
            ->firstOrFail();

        $user->roles()->sync([$request->role_id]);

        return response()->json([
            'success' => true,
            'message' => 'Role assigned to user'
        ]);
    }

    public function deleteUser(Request $request, $id)
    {
        // 1️⃣ Permission check
        if (!hasPermission(auth()->user(), 'delete_user')) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        // 2️⃣ Prevent self-delete
        if (auth()->id() == $id) {
            return response()->json([
                'message' => 'You cannot delete your own account'
            ], 403);
        }

        // 3️⃣ Tenant-scoped user fetch
        $user = User::where('enterprise_id', auth()->user()->enterprise_id)
            ->where('id', $id)
            ->firstOrFail();

        // 4️⃣ Delete user
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }

}
