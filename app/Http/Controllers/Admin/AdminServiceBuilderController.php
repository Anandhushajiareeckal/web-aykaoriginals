<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ServiceSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminServiceBuilderController extends Controller {
    public function index() {
        $sections = ServiceSection::all()->keyBy('section_key');
        return view('admin.service-builder.index', compact('sections'));
    }

    public function updateSection(Request $request, $key) {
        $v = $request->validate([
            'heading' => 'nullable|string',
            'subheading' => 'nullable|string',
            'body' => 'nullable|string',
            'btn1_label' => 'nullable|string',
            'btn1_url' => 'nullable|string',
            'image_file' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:20480',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi|max:51200',
            'video_url' => 'nullable|string|max:1000'
        ]);

        $section = ServiceSection::firstOrCreate(['section_key' => $key]);

        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->storePublicly('service_builder/videos', 'public');
            $section->video_url = '/storage/' . $path;
            $section->image_url = null;
        } elseif ($request->filled('video_url')) {
            $section->video_url = $request->video_url;
            $section->image_url = null;
        } elseif ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->storePublicly('service_builder/images', 'public');
            $section->image_url = '/storage/' . $path;
            $section->video_url = null;
        }

        $section->fill(collect($v)->except(['image_file', 'video_file', 'video_url'])->toArray());
        $section->save();

        return back()->with('success', ucfirst($key) . ' section updated.');
    }
}
