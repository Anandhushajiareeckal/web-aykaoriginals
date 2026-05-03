<?php
namespace App\Http\Controllers\Model;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Auth;

class ModelDashboardController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        $talent = $user->talent()->with('media')->first();

        $stats = [
            'completeness'   => $talent ? $talent->computeCompleteness() : 0,
            'portfolio_count'=> $talent ? $talent->getMedia('portfolio')->count() : 0,
            'comp_card_count'=> $talent ? $talent->getMedia('comp_card')->count() : 0,
            'status'         => $talent->status ?? 'draft',
        ];

        $approvedInquiries = $talent
            ? Inquiry::where('talent_id', $talent->id)
                     ->where('admin_approved', true)
                     ->latest()
                     ->get()
            : collect();

        return view('model.dashboard', compact('user', 'talent', 'stats', 'approvedInquiries'));
    }
}
