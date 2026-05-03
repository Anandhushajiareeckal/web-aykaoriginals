<?php
namespace App\Http\Controllers\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModelCompCardController extends Controller
{
    public function index()
    {
        $talent = Auth::user()->talent()->with('media')->firstOrFail();
        $compImages = $talent->getMedia('comp_card');
        return view('model.comp-card.index', compact('talent', 'compImages'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'images'   => 'required|array|max:5',
            'images.*' => 'image|max:10240',
        ]);

        $talent = Auth::user()->talent;
        foreach ($request->file('images') as $img) {
            $talent->addMedia($img)->toMediaCollection('comp_card');
        }

        return back()->with('success', 'Images uploaded to your comp card.');
    }

    public function deleteImage(Request $request, $mediaId)
    {
        $talent = Auth::user()->talent;
        $media  = $talent->getMedia('comp_card')->firstWhere('id', $mediaId);
        if ($media) $media->delete();
        return back()->with('success', 'Image removed.');
    }

    public function download()
    {
        $talent = Auth::user()->talent()->with('media')->firstOrFail();
        $compImages = $talent->getMedia('comp_card');
        return view('model.comp-card.print', compact('talent', 'compImages'));
    }
}
