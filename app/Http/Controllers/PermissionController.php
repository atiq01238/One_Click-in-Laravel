<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::get();
        return view('permission.index', [
            'permissions' => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // dd($request->all());

    $request->validate([
        'name' => 'required|string|unique:permissions,name'
    ]);

    try {
        Permission::create([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('success', 'Permission created successfully');
    } catch (\Exception $e) {
        \Log::error('Error creating permission: ' . $e->getMessage());

        return redirect()->back()->with('error', 'An error occurred while creating the permission. Please try again.');
    }
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

        $permission = Permission::findOrFail($id);

        return view('permission.edit', [
            'permission' => $permission
        ]);
    /**
     * Update the specified resource in storage.
     */
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $id
        ]);

        try {
            $permission = Permission::findOrFail($id);

            $permission->update([
                'name' => $request->name
            ]);

            return redirect('permissions')->with('success', 'Permission updated successfully');
        } catch (\Exception $e) {
            \Log::error('Error updating permission: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while updating the permission. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();

            return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
        } catch (\Exception $e) {
            \Log::error('Error deleting permission: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the permission. Please try again.');
        }
    }
}
