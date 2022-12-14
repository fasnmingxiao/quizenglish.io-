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
        return view('admin.management', ['active' => 'management', 'title' => 'Management', 'roles' => $data]);
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
}
