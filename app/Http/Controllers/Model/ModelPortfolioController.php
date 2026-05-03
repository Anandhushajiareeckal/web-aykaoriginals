<?php
namespace App\Http\Controllers\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModelPortfolioController extends Controller
{
    public function index()
    {
        $talent   = Auth::user()->talent()->with('media')->firstOrFail();
        $portfolio = $talent->getMedia('portfolio');
        return view('model.portfolio.index', compact('talent', 'portfolio'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'images'   => 'required|array|max:20',
            'images.*' => 'image|max:15360',
        ]);

        $talent   = Auth::user()->talent;
        $category = $request->input('category', 'general');

        foreach ($request->file('images') as $img) {
            $talent->addMedia($img)
                   ->withCustomProperties(['category' => $category])
                   ->toMediaCollection('portfolio');
        }

        $talent->update(['last_active_at' => now()]);
        return back()->with('success', 'Images uploaded to your portfolio.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['order' => 'required|array']);
        $talent = Auth::user()->talent;
        foreach ($request->order as $position => $mediaId) {
            $media = $talent->getMedia('portfolio')->firstWhere('id', $mediaId);
            if ($media) {
                $media->order_column = $position + 1;
                $media->save();
            }
        }
        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, $mediaId)
    {
        $talent = Auth::user()->talent;
        $media  = $talent->getMedia('portfolio')->firstWhere('id', $mediaId);
        if ($media) $media->delete();
        return back()->with('success', 'Image removed from portfolio.');
    }

    public function updateMeta(Request $request, $mediaId)
    {
        $request->validate(['category' => 'nullable|string|max:100']);
        $talent = Auth::user()->talent;
        $media  = $talent->getMedia('portfolio')->firstWhere('id', $mediaId);
        if ($media) {
            $media->setCustomProperty('category', $request->input('category', 'general'));
            $media->save();
        }
        return back()->with('success', 'Updated.');
    }
}
