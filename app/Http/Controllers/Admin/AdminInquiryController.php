<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
class AdminInquiryController extends Controller {
    public function index() {
        $status = request('status');
        $q = Inquiry::whereNull('talent_id')->latest();
        if($status) $q->where('status',$status);
        return view('admin.inquiries.index',['inquiries'=>$q->paginate(20),'status'=>$status]);
    }
    public function show(Inquiry $inquiry) {
        if($inquiry->status === 'new') $inquiry->update(['status'=>'read']);
        return view('admin.inquiries.show',['inquiry'=>$inquiry]);
    }
    public function update(Request $request, Inquiry $inquiry) {
        $inquiry->update(['status'=>$request->status]);
        return back()->with('success','Status updated.');
    }
    public function destroy(Inquiry $inquiry) { $inquiry->delete(); return back()->with('success','Inquiry deleted.'); }
}
