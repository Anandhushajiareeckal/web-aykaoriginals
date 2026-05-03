<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\HomepageSection;
use App\Models\ClientLogo;
use Illuminate\Http\Request;
class AdminHomepageController extends Controller {
    public function index() {
        $sections = HomepageSection::all()->keyBy('section_key');
        $clients  = ClientLogo::orderBy('sort_order')->get();
        return view('admin.homepage.index', compact('sections','clients'));
    }
    public function updateSection(Request $request, string $key) {
        $v = $request->validate([
            'heading'=>'nullable|string|max:255','subheading'=>'nullable|string|max:255',
            'body'=>'nullable|string','video_url'=>'nullable|string|max:500',
            'btn1_label'=>'nullable|string|max:100','btn1_url'=>'nullable|string|max:255',
            'btn2_label'=>'nullable|string|max:100','btn2_url'=>'nullable|string|max:255',
        ]);
        $v['is_active'] = $request->boolean('is_active',true);
        HomepageSection::updateOrCreate(['section_key'=>$key],$v);
        return back()->with('success','Section updated successfully.');
    }
    public function storeClient(Request $request) {
        $request->validate(['name'=>'required|string|max:255']);
        $client = ClientLogo::create(['name'=>$request->name,'sort_order'=>$request->sort_order??0,'is_active'=>true]);
        if($request->hasFile('logo')) $client->addMediaFromRequest('logo')->toMediaCollection('logo');
        return back()->with('success','Client added.');
    }
    public function destroyClient(ClientLogo $client) {
        $client->delete();
        return back()->with('success','Client removed.');
    }
}
