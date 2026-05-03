<?php
namespace App\Http\Controllers;
use App\Models\Inquiry;
use Illuminate\Http\Request;
class InquiryController extends Controller {
    public function create(Request $request) {
        $selectedTalentId = $request->input('talent');
        return view('inquiries.create', compact('selectedTalentId'));
    }
    public function store(Request $request) {
        $v = $request->validate([
            'name'=>'required|string|max:255','email'=>'required|email|max:255',
            'company'=>'nullable|string|max:255',
            'type'=>'required|in:talent_booking,campaign_production,editorial,lookbook,other',
            'message'=>'required|string|min:20|max:5000',
            'budget'=>'nullable|in:under_5k,5k_15k,15k_50k,50k_plus',
            'talent_id'=>'nullable|exists:talents,id',
        ]);
        $v['status'] = 'new';
        Inquiry::create($v);
        return redirect()->route('inquiries.create')->with('success','Thank you. We will be in touch within 24 hours.');
    }
}
