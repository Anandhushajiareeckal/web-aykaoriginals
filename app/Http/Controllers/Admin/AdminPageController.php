<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
class AdminPageController extends Controller {
    public function index() { return view('admin.pages.index',['pages'=>Page::orderBy('sort_order')->get()]); }
    public function create() { return view('admin.pages.form',['page'=>null]); }
    public function store(Request $request) {
        $v = $request->validate(['title'=>'required|string|max:255','slug'=>'nullable|string|unique:pages,slug','content'=>'nullable|string','meta_title'=>'nullable|string','meta_description'=>'nullable|string','template'=>'nullable|string','sort_order'=>'nullable|integer']);
        $v['is_active'] = $request->boolean('is_active',true);
        Page::create($v);
        return redirect()->route('admin.pages.index')->with('success','Page created.');
    }
    public function edit(Page $page) { return view('admin.pages.form',['page'=>$page]); }
    public function update(Request $request, Page $page) {
        $v = $request->validate(['title'=>'required|string|max:255','content'=>'nullable|string','meta_title'=>'nullable|string','meta_description'=>'nullable|string','template'=>'nullable|string','sort_order'=>'nullable|integer']);
        $v['is_active'] = $request->boolean('is_active',true);
        $page->update($v);
        return redirect()->route('admin.pages.index')->with('success','Page updated.');
    }
    public function destroy(Page $page) { $page->delete(); return back()->with('success','Page deleted.'); }
}
