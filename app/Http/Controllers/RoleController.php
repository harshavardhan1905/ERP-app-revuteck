<?php

namespace App\Http\Controllers;

use App\Models\Role; // <-- MUST HAVE THIS
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // ALL roles including trashed
        $allRoles = Role::withTrashed()->orderBy('role_level', 'asc')->get();

        // 1. Fetch all roles // Normal roles (NOT deleted)
        $roles = Role::orderBy('role_level', 'asc')->get();

        // 2. Pass the $roles variable to your view
        return view('Administration.roles', compact('roles', 'allRoles'));
    }

    public function trash()
        {
            $trashedRoles = Role::onlyTrashed()->get();

            return view('Administration.roles-trash', compact('trashedRoles'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'role_first_name' => 'required|string|max:50',
        'role_last_name'  => 'required|string|max:50',
        
        // FIX: Use the Rule class pointing to your Role model
        'role_code'       => [
            'required', 
            'string', 
            'max:100', 
            Rule::unique(\App\Models\Role::class, 'role_code')
        ],
        
        'role_category'   => 'required|string|max:50',
        'role_level'      => 'required|integer',
        'description'     => 'nullable|string',
    ]);

    // Format checkboxes
    $isSystemRole = $request->has('is_system_role') ? true : false;
    $isActive = $request->has('is_active') ? true : false;

    // Combine names
    $fullRoleName = trim($request->role_first_name . ' ' . $request->role_last_name);

    // Save to Database
    \App\Models\Role::create([
        'role_name'      => $fullRoleName,
        'role_code'      => $request->role_code,
        'role_category'  => $request->role_category,
        'role_level'     => $request->role_level,
        'description'    => $request->description,
        'is_system_role' => $isSystemRole,
        'is_active'      => $isActive,
    ]);

    return redirect('/roles')->with('success', 'Role created successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
    
        $request->validate([
            'role_first_name' => 'required',
            'role_last_name'  => 'required',
            'role_code'       => ['required', Rule::unique(\App\Models\Role::class)->ignore($role->id)],
            'role_category'   => 'required',
            'role_level'      => 'required',
        ]);

        $role->update([
            'role_name'      => trim($request->role_first_name . ' ' . $request->role_last_name),
            'role_code'      => $request->role_code,
            'role_category'  => $request->role_category,
            'role_level'     => $request->role_level,
            'description'    => $request->description,
            'is_system_role' => $request->has('is_system_role'),
            'is_active'      => $request->has('is_active'),
        ]);

        return redirect('/roles')->with('success', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::findOrFail($id)->delete(); // soft delete
        return redirect()->back()->with('success', 'Role moved to trash');
    }
    // Restore a role from the recycle bin
    public function restore($id)
    {
        $role = Role::withTrashed()->findOrFail($id);
        $role->restore(); // Clears the deleted_at timestamp

        return redirect('/roles')->with('success', 'Role restored successfully!');
    }
    
    // Permanently wipe a role from the database
    public function forceDelete($id)
            {
                Role::withTrashed()->findOrFail($id)->forceDelete();
                return redirect()->back()->with('success', 'Role permanently deleted');
            }
}
