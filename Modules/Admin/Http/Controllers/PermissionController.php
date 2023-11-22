<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionController extends Controller {

    function __construct() {

        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request) {
        $items = Permission::orderBy('id', 'DESC')->paginate(config("pageCount"));
        return view('admin::permissions.index', compact('items'))->with('i', ($request->input('page', 1) - 1) * config("pageCount"));
        ;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create() {
        return view('admin::permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'guard_name' => 'required',
        ]);
        Permission::create(['name' => $request->input('name'), 'guard_name' => $request->input('guard_name')]);
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id) {
        return view('admin::permissions.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id) {
        $permission = Permission::find($id);
        return view('admin::permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
        ]);
        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id) {
        DB::table("permissions")->where('id', $id)->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }

}
