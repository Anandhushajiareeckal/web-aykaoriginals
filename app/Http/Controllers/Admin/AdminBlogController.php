<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
class AdminBlogController extends Controller {
    public function index() { return view('admin.blog.index',['posts'=>BlogPost::latest()->paginate(20)]); }
    public function create() { return view('admin.blog.form',['post'=>null]); }
    public function store(Request $request) {
        $v = $request->validate(['title'=>'required|string|max:255','excerpt'=>'nullable|string','content'=>'nullable|string','category'=>'nullable|string','published_at'=>'nullable|date']);
        $v['is_active'] = $request->boolean('is_active',true);
        $post = BlogPost::create($v);
        if($request->hasFile('cover')) $post->addMediaFromRequest('cover')->toMediaCollection('cover');
        return redirect()->route('admin.blog.index')->with('success','Post created successfully.');
    }
    public function edit(BlogPost $post) { return view('admin.blog.form',['post'=>$post]); }
    public function update(Request $request, BlogPost $post) {
        $v = $request->validate(['title'=>'required|string|max:255','excerpt'=>'nullable|string','content'=>'nullable|string','category'=>'nullable|string','published_at'=>'nullable|date']);
        $v['is_active'] = $request->boolean('is_active',true);
        $post->update($v);
        if($request->hasFile('cover')) { $post->clearMediaCollection('cover'); $post->addMediaFromRequest('cover')->toMediaCollection('cover'); }
        return redirect()->route('admin.blog.index')->with('success','Post updated successfully.');
    }
    public function destroy(BlogPost $post) { $post->delete(); return back()->with('success','Post deleted.'); }
}
