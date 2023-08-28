<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {


        $users = User::get();

        return view('user.show_users', compact('users'));
    }
    public function Add_user()
    {
        $roles = Role::get();

        return view('user.add_user', compact('roles'));
    }
    public function store_user(UserRequest $request)
    {

        $user = User::create([


            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        $user->assignRole([$request->role]);
        return redirect('user')->with('msg', 'تم اضافة المستخدم بنجاح');
    }
    public function delete_user($id)
    {
        User::find($id)->delete();
        return redirect()->back();
    }
    public function edit_user($id)
    {

        $user = User::find($id);

        $userRole = $user->roles->pluck('name')->toArray();
        $roles = Role::latest()->get();
        return view('user.edit_user', compact('user', 'userRole', 'roles'));
    }
    public function update_user(UpdateUserRequest $request)
    {
        $user = User::find($request->id);
        $user->update([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->get('role'));
        return redirect('user');
    }
    public function mark_all_read()
    {
        $user = User::find(Auth::user()->id);
        $user->unreadNotifications->markAsRead();
        return redirect('/');
    }
}
