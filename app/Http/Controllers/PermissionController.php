<?php

namespace App\Http\Controllers;

use App\Models\Permission; // Model we created earlier
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all permissions including trashed (useful if you need a global list for some reason)
        $allPermissions = Permission::withTrashed()->orderBy('module_name', 'asc')->get();

        // Normal permissions (NOT deleted)
        $permissions = Permission::orderBy('module_name', 'asc')->get();

        // Pass variables to your view (assuming it's in the Administration folder)
        return view('Administration.permissions', compact('permissions', 'allPermissions'));
    }

    /**
     * Display soft deleted resources.
     */
    public function trash()
    {
        $trashedPermissions = Permission::onlyTrashed()->get();

        return view('Administration.permissions-trash', compact('trashedPermissions'));
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
        $request->validate([
            'module_name'     => 'required|string|max:100',
            'action_name'     => 'required|string|max:100',
            'permission_name' => 'required|string|max:150',
            
            // Validate code is unique to the Permission model
            'permission_code' => [
                'required', 
                'string', 
                'max:100', 
                Rule::unique(\App\Models\Permission::class, 'permission_code')
            ],
            
            'description'     => 'nullable|string',
        ]);

        // Format checkboxes (boolean)
        $isActive = $request->has('is_active') ? true : false;

        // Save to Database
        \App\Models\Permission::create([
            'module_name'     => $request->module_name,
            'action_name'     => $request->action_name,
            'permission_name' => $request->permission_name,
            'permission_code' => $request->permission_code,
            'description'     => $request->description,
            'is_active'       => $isActive,
        ]);

        return redirect('/permissions')->with('success', 'Permission created successfully!');
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
        $permission = Permission::findOrFail($id);
    
        $request->validate([
            'module_name'     => 'required|string|max:100',
            'action_name'     => 'required|string|max:100',
            'permission_name' => 'required|string|max:150',
            'permission_code' => ['required', 'string', 'max:100', Rule::unique(\App\Models\Permission::class)->ignore($permission->id)],
            'description'     => 'nullable|string',
        ]);

        $permission->update([
            'module_name'     => $request->module_name,
            'action_name'     => $request->action_name,
            'permission_name' => $request->permission_name,
            'permission_code' => $request->permission_code,
            'description'     => $request->description,
            'is_active'       => $request->has('is_active'),
        ]);

        return redirect('/permissions')->with('success', 'Permission updated successfully!');
    }

    /**
     * Remove the specified resource from storage (Soft Delete).
     */
    public function destroy(string $id)
    {
        Permission::findOrFail($id)->delete(); // soft delete
        return redirect()->back()->with('success', 'Permission moved to trash');
    }
    
    /**
     * Restore a permission from the recycle bin.
     */
    public function restore($id)
    {
        $permission = Permission::withTrashed()->findOrFail($id);
        $permission->restore(); // Clears the deleted_at timestamp

        return redirect('/permissions')->with('success', 'Permission restored successfully!');
    }
    
    /**
     * Permanently wipe a permission from the database.
     */
    public function forceDelete($id)
    {
        Permission::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->back()->with('success', 'Permission permanently deleted');
    }
}