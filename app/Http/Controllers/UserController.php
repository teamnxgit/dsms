<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Redirect;
use Session;


class UserController extends Controller
{
    public function index(){
        $data['users'] = User::with('roles')->paginate(10);
        return view('cms.user.users')->with($data);
    }

    public function user(Request $request){
        
        $roles = Role::all();
        $user = User::findOrFail($request->id)->first();

        $user_permissions = $user->getAllPermissions();

        $used_permissions=[];
        foreach ($user_permissions as $permission) {
            array_push($used_permissions,$permission->id);
        }
        
        $permissions = Permission::whereNotIn('id',$used_permissions)->get();

        $data['user'] = $user;
        $data['roles'] = $roles;
        $data['permissions']=$permissions;
        $data['user_permissions'] = $user_permissions;
        
        return view('cms.user.user_detail')->with($data);


    }

    public function addPermission(Request $request){
        $user = User::findOrFail($request->id);
        $permission = Permission::findOrFail($request->input('permission_id'));
        $user->givePermissionTo($permission->name);
        Session::flash('success', 'Permission Added');
        return Redirect::back();
    }

    public function remPermission(Request $request){
        $user = User::findOrFail($request->id);
        $permission = Permission::findOrFail($request->input('permission_id'));
        $user->revokePermissionTo($permission->name);
        Session::flash('success', 'Permission Removed');
        return Redirect::back();
    }

    public function updateUser(Request $request){
        $user = User::findOrFail($request->id);
        // Updating User Info
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        // Role Assignment
        $role = Role::findOrFail($request->input('role_id'));
        $user->assignRole($role->name);
    }
}
