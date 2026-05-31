<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;

class AdminAboutController extends Controller {
    public function index() {
        $sections = AboutSection::all()->keyBy('section_key');
        return view('admin.about.index', compact('sections'));
    }

    public function updateSection(Request $request, string $key) {
        $v = $request->validate([
            'heading' => 'nullable|string|max:255',
            'subheading' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'image_url' => 'nullable|string|max:500',
            'video_url' => 'nullable|string|max:500',
            'video_file' => 'nullable|file|mimetypes:video/mp4,video/x-m4v,video/quicktime|max:102400',
            'image_file' => 'nullable|image|max:10240',
            'btn1_label' => 'nullable|string|max:100',
            'btn1_url' => 'nullable|string|max:255',
        ]);
        
        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->storePublicly('about_videos', 'public');
            $v['video_url'] = '/storage/' . $path;
        }
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->storePublicly('about_images', 'public');
            $v['image_url'] = '/storage/' . $path;
        }
        unset($v['video_file'], $v['image_file']);

        $v['is_active'] = $request->boolean('is_active', true);
        AboutSection::updateOrCreate(['section_key' => $key], $v);
        
        return back()->with('success', 'About Section updated successfully.');
    }
}
