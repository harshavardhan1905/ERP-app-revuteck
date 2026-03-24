<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;

class RolesPermissionsController extends Controller
{
    /**
     * 🔹 1. INDEX PAGE (NEW PAGE 🔥)
     * Show all roles + permissions (LEFT JOIN)
     */
    public function index()
    {
        $data = DB::table('master_erp.role_permissions as a')
            ->leftJoin('master_erp.roles as b', 'a.role_id', '=', 'b.id')
            ->leftJoin('master_erp.permissions as c', 'a.permission_id', '=', 'c.id')
            ->select(
                'b.id as role_id',
                'b.role_name',
                'b.role_code',
                'b.role_level',
                'c.id as permission_id',
                'c.permission_name',
                'c.module_name',
                'c.action_name'
            )
            ->orderBy('b.role_level')
            ->orderBy('c.module_name')
            ->get();

        return view('Administration.roles-permissions', compact('data'));
    }

    /**
     * 🔹 2. MANAGE SINGLE ROLE
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        $permissions = Permission::where('is_active', true)
            ->get()
            ->groupBy('module_name');

        return view('Administration.roles-permissions', compact('role', 'permissions'));
    }

    /**
     * 🔹 3. UPDATE ROLE PERMISSIONS (CHECKBOX MATRIX)
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // 🚨 LEVEL SECURITY
        if (auth()->user()->role->role_level > $role->role_level) {
            abort(403, 'Unauthorized action');
        }

        $role->permissions()->sync($request->permissions ?? []);

        return back()->with('success', 'Permissions updated successfully!');
    }

    /**
     * 🔹 4. ADD SINGLE PERMISSION TO ROLE (NEW 🔥)
     */
    public function assignPermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        DB::table('role_permissions')->insert([
            'role_id' => $request->role_id,
            'permission_id' => $request->permission_id,
            'created_at' => now(),
        ]);

        return back()->with('success', 'Permission assigned to role!');
    }


     public function assignPage($id)
        {
            $role = Role::with('permissions')->findOrFail($id);

            $permissions = Permission::where('is_active', true)->get();

            return view('Administration.assign-permissions', compact('role', 'permissions'));
        }
    /**
     * 🔹 5. CREATE NEW PERMISSION
     */
    public function storePermission(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:200',
            'module' => 'required|string|max:100',
            'action' => 'required|in:create,view,edit,delete',
            'level'  => 'required|integer|min:1',
        ]);

        Permission::create([
            'permission_name' => $request->name,
            'permission_code' => strtolower($request->module . '.' . $request->action),
            'module_name'     => strtolower($request->module),
            'action_name'     => strtolower($request->action),
            'level'           => $request->level,
            'is_active'       => true,
        ]);

        return back()->with('success', 'New permission created!');
    }
}