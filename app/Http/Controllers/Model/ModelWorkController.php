<?php
namespace App\Http\Controllers\Model;
use App\Http\Controllers\Controller;
use App\Models\TalentWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModelWorkController extends Controller
{
    public function index()
    {
        $talent = Auth::user()->talent;
        $works  = $talent->highlightWorks()->with('media')->get();
        return view('model.works.index', compact('talent', 'works'));
    }

    public function store(Request $request)
    {
        $talent = Auth::user()->talent;
        
        if ($talent->highlightWorks()->count() >= 3) {
            return back()->with('error', 'You can only have up to 3 highlight works.');
        }

        $v = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'images'      => 'required|array|min:1|max:3',
            'images.*'    => 'image|max:10240',
        ]);

        $work = $talent->highlightWorks()->create([
            'title'       => $v['title'],
            'description' => $v['description'] ?? null,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $work->addMedia($img)->toMediaCollection('images');
            }
        }

        return back()->with('success', 'Work added successfully.');
    }

    public function update(Request $request, TalentWork $work)
    {
        $this->authorizeOwner($work);

        $v = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'new_images'  => 'nullable|array|max:3',
            'new_images.*'=> 'image|max:10240',
        ]);

        $work->update([
            'title'       => $v['title'],
            'description' => $v['description'] ?? $work->description,
        ]);

        if ($request->hasFile('new_images')) {
            // Should we clear old images or just append? 
            // User said "one work contains 2-3 images". I'll let them manage.
            foreach ($request->file('new_images') as $img) {
                $work->addMedia($img)->toMediaCollection('images');
            }
        }

        return back()->with('success', 'Work updated.');
    }

    public function destroy(TalentWork $work)
    {
        $this->authorizeOwner($work);
        $work->delete();
        return back()->with('success', 'Work deleted.');
    }

    public function deleteImage(TalentWork $work, $mediaId)
    {
        $this->authorizeOwner($work);
        $media = $work->getMedia('images')->firstWhere('id', $mediaId);
        if ($media) $media->delete();
        return back()->with('success', 'Image removed.');
    }

    private function authorizeOwner(TalentWork $work)
    {
        if ($work->talent_id !== Auth::user()->talent->id) {
            abort(403);
        }
    }
}
