<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
class AdminProjectController extends Controller {
    public function index() { return view('admin.projects.index',['projects'=>Project::orderByDesc('year')->paginate(20)]); }
    public function create() { return view('admin.projects.form',['project'=>null]); }
    public function store(Request $request) {
        $v = $request->validate(['brand'=>'required|string|max:255','year'=>'nullable|integer','service_type'=>'nullable|string','description'=>'nullable|string']);
        $v['is_featured'] = $request->boolean('is_featured');
        $v['is_active']   = $request->boolean('is_active', true);
        $project = Project::create($v);
        if($request->hasFile('gallery_images')) {
            foreach($request->file('gallery_images') as $img) $project->addMedia($img)->toMediaCollection('gallery');
        }
        return redirect()->route('admin.projects.index')->with('success','Project created successfully.');
    }
    public function edit(Project $project) { return view('admin.projects.form',['project'=>$project]); }
    public function update(Request $request, Project $project) {
        $v = $request->validate(['brand'=>'required|string|max:255','year'=>'nullable|integer','service_type'=>'nullable|string','description'=>'nullable|string']);
        $v['is_featured'] = $request->boolean('is_featured');
        $v['is_active']   = $request->boolean('is_active', true);
        $project->update($v);
        if($request->hasFile('gallery_images')) {
            foreach($request->file('gallery_images') as $img) $project->addMedia($img)->toMediaCollection('gallery');
        }
        return redirect()->route('admin.projects.index')->with('success','Project updated successfully.');
    }
    public function destroy(Project $project) { $project->delete(); return back()->with('success','Project deleted.'); }
}
