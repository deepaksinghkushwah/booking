<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;

class PageCategoryController extends Controller {

    function __construct() {
        $this->middleware('permission:pageCategory-list|pageCategory-create|pageCategory-edit|pageCategory-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:pageCategory-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pageCategory-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pageCategory-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request) {
        $items = \App\Models\PageCategory::orderBy('id', 'DESC')->paginate(config('pageCount'));
        return view('admin::page-categories.index', compact('items'))->with('i', ($request->input('page', 1) - 1) * config("pageCount"));
    }

    public function create() {
        return view('admin::page-categories.create');
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|unique:page_categories'
        ]);
        $data = $request->all();
        $cat = \App\Models\PageCategory::create([
                    'title' => $data['title'],
                    'parent_id' => 0,
        ]);
        return redirect()->route('page-categories.index')->with('success', 'Page category created');
    }

    public function edit($id) {
        $cat = \App\Models\PageCategory::find($id);
        return view('admin::page-categories.edit', compact('cat'));
    }

    public function update(Request $request, $id) {
        $cat = \App\Models\PageCategory::find($id);
        $request->validate([
            'title' => 'required|unique:page_categories,title,' . $id,
        ]);
        $data = $request->all();
        $cat->title = $data['title'];
        $cat->save();
        return redirect()->route('page-categories.index')->with('success', 'Page category updated');
    }

    public function destroy($id) {        
        if ((int)$id != 1 && (int)$id != 2) {
            DB::table('page_categories')->where("id", $id)->delete();
            return redirect()->route("page-categories.index")->with('success', 'Page category deleted');
        } else {
            return redirect()->route("page-categories.index")->with('danger', 'Page category can not be deleted');
        }
    }

}
