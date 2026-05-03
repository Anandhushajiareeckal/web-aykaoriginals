<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Talent;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class AdminModelController extends Controller
{
    public function index()
    {
        $models = Talent::models()
                        ->with('media','user')
                        ->orderByDesc('updated_at')
                        ->paginate(25);
        return view('admin.models.index', compact('models'));
    }

    /** Show a single model's profile + their inquiries */
    public function show(Talent $talent)
    {
        $inquiries = Inquiry::where('talent_id', $talent->id)
                            ->latest()
                            ->paginate(20);
        return view('admin.models.show', compact('talent', 'inquiries'));
    }

    public function edit(Talent $talent)
    {
        return view('admin.models.edit', compact('talent'));
    }

    public function update(Request $request, Talent $talent)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:talents,slug,' . $talent->id,
            'category' => 'nullable|string|max:255',
            'gender' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'height' => 'nullable|string|max:255',
            'chest_bust' => 'nullable|string|max:255',
            'waist' => 'nullable|string|max:255',
            'hips' => 'nullable|string|max:255',
            'weight' => 'nullable|string|max:255',
            'inseam' => 'nullable|string|max:255',
            'shoe_size' => 'nullable|string|max:255',
            'eye_color' => 'nullable|string|max:255',
            'hair_color' => 'nullable|string|max:255',
        ]);

        $talent->update($data);

        return redirect()->route('admin.models.index')->with('success', 'Model profile updated successfully.');
    }

    /** Toggle admin approval of a single inquiry */
    public function approveInquiry(Talent $talent, Inquiry $inquiry)
    {
        $inquiry->update([
            'admin_approved'    => ! $inquiry->admin_approved,
            'admin_approved_at' => $inquiry->admin_approved ? null : now(),
        ]);
        $msg = $inquiry->admin_approved
            ? 'Inquiry approved — the model can now see it.'
            : 'Inquiry approval revoked.';
        return back()->with('success', $msg);
    }

    public function approve(Talent $talent)
    {
        $talent->update(['status' => 'approved', 'is_active' => true]);
        return back()->with('success', "{$talent->name}'s profile has been approved and is now live.");
    }

    public function reject(Talent $talent)
    {
        $talent->update(['status' => 'rejected', 'is_active' => false]);
        return back()->with('success', "{$talent->name}'s profile has been rejected.");
    }

    public function feature(Talent $talent)
    {
        $talent->update(['is_featured' => !$talent->is_featured]);
        $msg = $talent->is_featured ? 'featured' : 'unfeatured';
        return back()->with('success', "{$talent->name} has been {$msg}.");
    }

    public function destroy(Talent $talent)
    {
        $talent->delete();
        return back()->with('success', 'Model profile deleted.');
    }
}
