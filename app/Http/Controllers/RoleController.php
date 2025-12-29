<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * 
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $permission = Permission::orderBy('id', 'ASC')->get();
        return view('roles.index', compact('roles', 'permission'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name|min:3',
        ]);
        if ($validator->fails()) {
            return redirect()->route('roles.create')->withErrors($validator);
        }
        $role = Role::create([
            'name' => $request->name,
        ]);

        if (($request->permission)) { {
                $role->givePermissionTo($request->permission);
            }
        }
        return redirect()->route('roles.index')->with('success', 'Role Created Successfully!');
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
        $permissions = Permission::all();
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('roles.edit', $id)->withErrors($validator);
        }
        $role->update([
            'name' => $request->name,
        ]);
        if (($request->permission)) { {
                $role->syncPermissions($request->permission);
            }
        } else {
            $role->syncPermissions([]);
        }
        return redirect()->route('roles.index')->with('success', 'Role Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
