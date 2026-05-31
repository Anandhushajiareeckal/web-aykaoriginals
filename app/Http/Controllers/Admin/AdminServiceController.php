<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
class AdminServiceController extends Controller {
    public function index() { return view('admin.services.index',['services'=>Service::orderBy('sort_order')->get()]); }
    public function create() { return view('admin.services.form',['service'=>null]); }
    public function store(Request $request) {
        $v = $request->validate(['title'=>'required|string|max:255','description'=>'nullable|string','content'=>'nullable|string','icon'=>'nullable|string','tag'=>'nullable|string|max:100','sort_order'=>'nullable|integer','image_file'=>'nullable|image|max:10240','banner_file'=>'nullable|image|max:10240']);
        $v['is_active'] = $request->boolean('is_active',true);
        $v['slug'] = \Illuminate\Support\Str::slug($request->title);
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->storePublicly('service_images', 'public');
            $v['image_url'] = '/storage/' . $path;
        }
        if ($request->hasFile('banner_file')) {
            $path = $request->file('banner_file')->storePublicly('service_banners', 'public');
            $v['banner_image'] = '/storage/' . $path;
        }
        unset($v['image_file'], $v['banner_file']);
        Service::create($v);
        return redirect()->route('admin.services.index')->with('success','Service created.');
    }
    public function edit(Service $service) { return view('admin.services.form',['service'=>$service]); }
    public function update(Request $request, Service $service) {
        $v = $request->validate(['title'=>'required|string|max:255','description'=>'nullable|string','content'=>'nullable|string','icon'=>'nullable|string','tag'=>'nullable|string|max:100','sort_order'=>'nullable|integer','image_file'=>'nullable|image|max:10240','banner_file'=>'nullable|image|max:10240']);
        $v['is_active'] = $request->boolean('is_active',true);
        $v['slug'] = \Illuminate\Support\Str::slug($request->title);
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->storePublicly('service_images', 'public');
            $v['image_url'] = '/storage/' . $path;
        }
        if ($request->hasFile('banner_file')) {
            $path = $request->file('banner_file')->storePublicly('service_banners', 'public');
            $v['banner_image'] = '/storage/' . $path;
        }
        unset($v['image_file'], $v['banner_file']);
        $service->update($v);
        return redirect()->route('admin.services.index')->with('success','Service updated.');
    }
    public function destroy(Service $service) { $service->delete(); return back()->with('success','Service deleted.'); }
}
