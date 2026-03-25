<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Validation\Rule; // <--- MUST BE HERE, AT THE TOP

class RolesPermissionsController extends Controller
{
    /**
     * 🔹 1. INDEX PAGE (NEW PAGE 🔥)
     * Show all roles + permissions (LEFT JOIN)
     */
    public function index()
    {
        $raw_data = DB::table('master_erp.role_permissions as a')
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

        // 2. Group the data by Role ID so we only have ONE row per role
        $data = $raw_data->groupBy('role_id')->map(function ($permissionsList, $role_id) {
            $first = $permissionsList->first(); // Get the role details from the first item

            return (object) [
                'role_id'    => $role_id,
                'role_name'  => $first->role_name,
                'role_code'  => $first->role_code,
                'role_level' => $first->role_level,

                // Extract a unique array of Modules (e.g., ['USER', 'COMPANY', 'BRANCH'])
                'modules'    => $permissionsList->pluck('module_name')->unique()->filter()->values(),

                // Count occurrences of each action (e.g., ['CREATE' => 5, 'VIEW' => 12, 'DELETE' => 2])
                'actions' => $permissionsList->groupBy('action_name')->map(function ($items) {
                    return $items->pluck('module_name')->unique()->filter()->values();
                })->filter(),

                // Extract a clean array of all permission names
                'permissions' => $permissionsList->pluck('permission_name')->filter()->values(),
            ];
        })->values(); // Reset the keys
        $permissions = Permission::where('is_active', true)->get()->groupBy('module_name');
        return view('Administration.roles-permissions', compact('data', 'permissions'));
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


    /**
     * 🔹 4. ADD SINGLE PERMISSION TO ROLE (NEW 🔥)
     */


    public function update(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:pgsql.master_erp.roles,id',
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'required|exists:pgsql.master_erp.permissions,id',
        ]);

        try {
            $role = Role::findOrFail($request->role_id);

            // ✅ Get already assigned permissions
            $existing = $role->permissions()->pluck('permission_id')->toArray();

            // ✅ Separate new & duplicate
            $newPermissions = array_diff($request->permission_ids, $existing);
            $duplicatePermissions = array_intersect($request->permission_ids, $existing);

            // ✅ Insert only new ones
            if (!empty($newPermissions)) {
                $role->permissions()->attach($newPermissions);
            }

            // ✅ Build message
            $messages = [];

            if (!empty($newPermissions)) {
                $messages[] = count($newPermissions) . " permission(s) assigned successfully";
            }

            if (!empty($duplicatePermissions)) {
                $messages[] = count($duplicatePermissions) . " already existed (skipped)";
            }

            if (empty($newPermissions) && empty($duplicatePermissions)) {
                return back()->with('error', 'No valid permissions selected');
            }

            return back()->with('success', implode(' | ', $messages));
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    public function assignPage($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        $permissions = Permission::where('is_active', true)->get();

        return view('Administration.roles-permissions', compact('role', 'permissions'));
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
