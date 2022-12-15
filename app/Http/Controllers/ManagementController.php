<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManagementController extends Controller
{
    public function index()
    {
        $data = Role::with('permissions')->get();
        $permissions= Permission::all();
        return view('admin.management', ['active' => 'management', 'title' => 'Management', 'roles' => $data, 'permissions' => $permissions]);
    }
    public function unsetpermission(Request $request)
    {
        $role = Role::find($request->role);
        $permission = Permission::find($request->permission);

        $rs = $role->revokePermissionTo($permission);
        if ($rs) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
    public function getPermissionDiff(Request $request)
    {
        $role = Role::find($request->role);
        $permission1 = Permission::all();
        $permission2 = $role->permissions;
        $rs = $permission1->diff($permission2);
        return response()->json($rs);
    }
    public function addRole(Request $request)
    {
        $role = Role::create(['name'=> $request->name]);
        foreach ($request->role as $permission) {
            $per = Permission::find($permission);
            $role->givePermissionTo($per);
        }
        return redirect()->route('management.index')->with('success', 'Create role successfully!!!');
    }
    public function deleteRole($id){
        Role::find($id)->delete();
        return redirect()->route('management.index')->with('success', 'Delete successfully!!!');
    }
    public function getRole($id){
        $permission = Permission::all();
        $data = Role::with('permissions')->find($id);
        return response()->json(['role' => $data, 'per' => $permission]);

    }
    public function updateRole(Request $request)
    {
        $role = Role::find($request->update_role_id);
        $role->name = $request->update_role_name;
        $role->save();
        foreach( $request->permissions as $permission)
        {
            $per = Permission::find($permission);
            $role->givePermissionTo($per);
        }
        return redirect()->route('management.index')->with('success', 'Update successfully!!!');
    }
}
