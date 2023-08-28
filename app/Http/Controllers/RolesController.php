<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{

    public function index()
    {
        $roles = Role::paginate(5);



        return view('role.role_show', compact('roles'));
    }
    public function add_role()
    {
        $permission = Permission::get();

        return view('role.add_role', compact('permission'));
    }
    public function add_permission_role(RoleRequest $request)
    {
        $role = Role::create(['name' => $request->get('role_name')]);
        $role->syncPermissions($request->get('permission'));

        return redirect('role')->with('Msg_s', 'تم اضافه القاعده بنجاح');
    }
    public function show_role($id)
    {

        $role = Role::findById($id);
        return view('role.show_rolebyid', compact('role'));
    }
    public function delete_role($id)
    {
        Role::find($id)->delete();
        return redirect()->back()->with('success', 'تم حذف القاعده بنجاح');
    }
    public function edit_role($id)
    {

        $role = Role::findById($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        // $permission_selected  = Role::findById(1)->permissions->pluck('id')->toArray();
        $permissions = Permission::get();

        return view('role.edit_role', compact('rolePermissions', 'permissions', 'role'));
    }
    public function update_role(Request $request)
    {
        $role = Role::findById($request->id);

        if (!$role) {
            return redirect('role')->with('error', 'هذا الدور غير موجود.');
        }

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->update([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->get('permission'));

        return redirect('role')->with('success', 'تم التعديل بنجاح');
    }
}
