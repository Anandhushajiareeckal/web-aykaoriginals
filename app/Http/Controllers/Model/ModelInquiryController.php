<?php
namespace App\Http\Controllers\Model;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Auth;

class ModelInquiryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $talent = $user->talent;

        if (!$talent) {
            abort(404);
        }

        // Fetch inquiries. The view will show count of ALL, but list only APPROVED.
        $allCount = Inquiry::where('talent_id', $talent->id)->count();
        
        $approvedInquiries = Inquiry::where('talent_id', $talent->id)
                                    ->where('admin_approved', true)
                                    ->latest()
                                    ->paginate(20);

        return view('model.inquiries.index', compact('talent', 'allCount', 'approvedInquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        $user = Auth::user();
        $talent = $user->talent;

        if (!$talent || $inquiry->talent_id !== $talent->id || !$inquiry->admin_approved) {
            abort(404);
        }

        return view('model.inquiries.show', compact('talent', 'inquiry'));
    }
}
