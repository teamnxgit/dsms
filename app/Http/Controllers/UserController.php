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
        $user = User::findOrFail($request->id);

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

    public function seedUser(){
        // Defining Permissions
        $permissions = [
            ['name' => 'View Person'],
            ['name' => 'View Attendance'],
            ['name' => 'View Social Security'],
            ['name' => 'View Samurdhi'],
            ['name' => 'View Users'],
            ['name' => 'User Password'],
            ['name' => 'User Permission'],
            ['name' => 'Delete User']
        ];
        // Inserting Permission Into Database which not exist
        foreach ($permissions as $permission) {
            if(Permission::where('name',$permission['name'])->first()===null){
                Permission::create($permission);
            }
        }

        // Defining Roles
        $roles = [
            ['name' => 'DS'],
            ['name' => 'ADS'],
            ['name' => 'ADP'],
            ['name' => 'Accountant'],
            ['name' => 'AO'],
            ['name' => 'DO'],
            ['name' => 'MSO'],
            ['name' => 'EDO'],
            ['name'=>'ICTA'],
            ['name'=>'SSO']
        ];

        // Inserting Roles Into Database which not exist

        foreach ($roles as $role) {
            if(Role::where('name',$role['name'])->first()===null){
                Role::create($role);
            }
        }

        
        $user = User::where('email','mail2snasik@gmail.com')->first();
        $role = Role::where('name','ICTA')->first();

        $user->assignRole($role->name);
        $user->givePermissionTo('View Users');
        $user->givePermissionTo('User Password');
        $user->givePermissionTo('User Permission');
        $user->givePermissionTo('Delete User');

    }
}
