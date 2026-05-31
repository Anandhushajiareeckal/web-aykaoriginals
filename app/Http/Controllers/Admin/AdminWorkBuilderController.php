<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminWorkBuilderController extends Controller
{
    public function index()
    {
        $sections = WorkSection::all()->keyBy('section_key');
        return view('admin.work-builder.index', compact('sections'));
    }

    public function updateSection(Request $request, $sectionKey)
    {
        $data = $request->validate([
            'heading' => 'nullable|string',
            'subheading' => 'nullable|string',
            'body' => 'nullable|string',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,webm|max:20480',
            'remove_media' => 'nullable|boolean',
        ]);

        $section = WorkSection::firstOrNew(['section_key' => $sectionKey]);
        $section->heading = $data['heading'] ?? $section->heading;
        $section->subheading = $data['subheading'] ?? $section->subheading;
        $section->body = $data['body'] ?? $section->body;

        if ($request->boolean('remove_media') && $section->media_url) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $section->media_url));
            $section->media_url = null;
            $section->media_type = null;
        }

        if ($request->hasFile('media')) {
            if ($section->media_url) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $section->media_url));
            }
            $file = $request->file('media');
            $path = $file->store('builder', 'public');
            $section->media_url = '/storage/' . $path;
            
            $mime = $file->getMimeType();
            $section->media_type = str_starts_with($mime, 'video/') ? 'video' : 'image';
        }

        $section->save();

        return back()->with('success', 'Section updated successfully.');
    }
}
