<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
class AdminGalleryController extends Controller {
    public function index() { return view('admin.gallery.index',['items'=>GalleryItem::orderBy('sort_order')->paginate(30)]); }
    public function store(Request $request) {
        $request->validate(['images'=>'required','images.*'=>'image|max:10240']);
        foreach($request->file('images') as $img) {
            $item = GalleryItem::create(['title'=>$request->title,'category'=>$request->category,'is_active'=>true]);
            $item->addMedia($img)->toMediaCollection('image');
        }
        return back()->with('success','Images uploaded successfully.');
    }
    public function destroy(GalleryItem $item) { $item->delete(); return back()->with('success','Item deleted.'); }
}
