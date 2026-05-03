<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Talent;
use Illuminate\Http\Request;
class AdminTalentController extends Controller {
    public function index() { return view('admin.talent.index',['talents'=>Talent::talents()->orderBy('name')->paginate(20)]); }
    public function create() { return view('admin.talent.form',['talent'=>null]); }
    public function store(Request $request) {
        $v = $request->validate(['name'=>'required|string|max:255','gender'=>'nullable|string','category'=>'nullable|string','location'=>'nullable|string','height'=>'nullable|string','chest_bust'=>'nullable|string','waist'=>'nullable|string','hips'=>'nullable|string','shoe_size'=>'nullable|string','eye_color'=>'nullable|string','hair_color'=>'nullable|string','bio'=>'nullable|string','is_featured'=>'boolean','is_active'=>'boolean']);
        $v['is_featured'] = $request->boolean('is_featured');
        $v['is_active']   = $request->boolean('is_active');
        $v['type']        = 'talent';
        $talent = Talent::create($v);
        if($request->hasFile('profile_image')) $talent->addMediaFromRequest('profile_image')->toMediaCollection('profile');
        if($request->hasFile('portfolio_images')) {
            foreach($request->file('portfolio_images') as $img) $talent->addMedia($img)->toMediaCollection('portfolio');
        }
        return redirect()->route('admin.talent.index')->with('success','Talent created successfully.');
    }
    public function edit(Talent $talent) { return view('admin.talent.form',['talent'=>$talent]); }
    public function update(Request $request, Talent $talent) {
        $v = $request->validate(['name'=>'required|string|max:255','gender'=>'nullable|string','category'=>'nullable|string','location'=>'nullable|string','height'=>'nullable|string','chest_bust'=>'nullable|string','waist'=>'nullable|string','hips'=>'nullable|string','shoe_size'=>'nullable|string','eye_color'=>'nullable|string','hair_color'=>'nullable|string','bio'=>'nullable|string']);
        $v['is_featured'] = $request->boolean('is_featured');
        $v['is_active']   = $request->boolean('is_active');
        $talent->update($v);
        if($request->hasFile('profile_image')) { $talent->clearMediaCollection('profile'); $talent->addMediaFromRequest('profile_image')->toMediaCollection('profile'); }
        if($request->hasFile('portfolio_images')) {
            foreach($request->file('portfolio_images') as $img) $talent->addMedia($img)->toMediaCollection('portfolio');
        }
        return redirect()->route('admin.talent.index')->with('success','Talent updated successfully.');
    }
    public function destroy(Talent $talent) { $talent->delete(); return back()->with('success','Talent deleted.'); }
}
