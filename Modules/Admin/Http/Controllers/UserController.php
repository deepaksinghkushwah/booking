<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use DB;

class UserController extends Controller {

    function __construct() {

        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request) {
        $users = \App\Models\User::orderBy('id', 'DESC')->paginate(config("pageCount"));

        return view('admin::users.index', compact('users'))
                        ->with('i', ($request->input('page', 1) - 1) * config("pageCount"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin::users.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $user = \App\Models\User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => \Illuminate\Support\Facades\Hash::make($data['password'])
        ]);

        $user->syncPermissions($data['permissions']);
        $user->syncRoles($data['roles']);

        return redirect()->route('users.index')
                        ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $role = Role::find($id);

        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
                ->where("role_has_permissions.role_id", $id)
                ->get();

        return view('admin::users.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $user = \App\Models\User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin::users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = \App\Models\User::find($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' =>  'required_without:permissions',            
            'permissions' => 'required_without:roles',            
        ]);
        $data = $request->all();
        
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();
        
        if(isset($data['permissions'])){            
            $user->syncPermissions($data['permissions']);
        } else {
            $user->syncPermissions([]);
        }
        
        if(isset($data['roles'])){            
            $user->syncRoles($data['roles']);
        } else {
            $user->syncRoles([]);
        }
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        DB::table("users")->where('id', $id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
    
    public function dashboard()
    {
        return view('user.dashboard');
    }

}
