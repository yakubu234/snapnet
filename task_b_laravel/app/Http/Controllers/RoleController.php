<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function assignRole(Request $request, User $user)
    {
        $this->authorize('manage-roles'); // Admin-only policy

        $role = Role::where('name', $request->role)->firstOrFail();
        $user->roles()->syncWithoutDetaching([$role->id]);

        return response()->json(['message' => 'Role assigned successfully.']);
    }

    public function removeRole(Request $request, User $user)
    {
        $this->authorize('manage-roles'); // Admin-only policy

        $role = Role::where('name', $request->role)->firstOrFail();
        $user->roles()->detach($role->id);

        return response()->json(['message' => 'Role removed successfully.']);
    }
}
