<?php
namespace App\Http\Controllers\Model;
use App\Http\Controllers\Controller;
use App\Models\Talent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ModelProfileController extends Controller
{
    private function getTalent(): Talent
    {
        $user   = Auth::user();
        $talent = $user->talent;
        if (!$talent) {
            $talent = Talent::create([
                'user_id' => $user->id,
                'name'    => $user->name,
                'slug'    => Str::slug($user->name) . '-' . $user->id,
                'status'  => 'draft',
                'is_active' => false,
            ]);
        }
        return $talent;
    }

    public function edit()
    {
        $talent = $this->getTalent();
        $talent->load('media');
        return view('model.profile.edit', compact('talent'));
    }

    public function checkSlug(Request $request)
    {
        $slug = Str::slug($request->input('slug'));
        if (!$slug) return response()->json(['available' => false, 'error' => 'Invalid username']);
        
        $talent = $this->getTalent();
        $exists = Talent::where('slug', $slug)->where('id', '!=', $talent->id)->exists();
        
        return response()->json([
            'available' => !$exists,
            'slug' => $slug
        ]);
    }

    public function update(Request $request)
    {
        $talent = $this->getTalent();

        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:talents,slug,' . $talent->id,
            'bio'          => 'nullable|string|max:2000',
            'location'     => 'nullable|string|max:255',
            'gender'       => 'nullable|string',
            'category'     => 'nullable|string|max:255',
            'height'       => 'nullable|string|max:50',
            'chest_bust'   => 'nullable|string|max:50',
            'waist'        => 'nullable|string|max:50',
            'hips'         => 'nullable|string|max:50',
            'weight'       => 'nullable|string|max:50',
            'inseam'       => 'nullable|string|max:50',
            'shoe_size'    => 'nullable|string|max:50',
            'eye_color'    => 'nullable|string|max:50',
            'hair_color'   => 'nullable|string|max:50',
            'social_instagram' => 'nullable|string|max:255',
            'social_facebook'  => 'nullable|string|max:255',
            'social_tiktok'    => 'nullable|string|max:255',
            'social_twitter'   => 'nullable|string|max:255',
        ]);


        // Build social_links array
        $data['social_links'] = array_filter([
            'instagram' => $request->input('social_instagram'),
            'facebook'  => $request->input('social_facebook'),
            'tiktok'    => $request->input('social_tiktok'),
            'twitter'   => $request->input('social_twitter'),
        ]);
        unset($data['social_instagram'], $data['social_facebook'], $data['social_tiktok'], $data['social_twitter']);

        // Ensure slug is sanitized
        $data['slug'] = Str::slug($data['slug']);

        // Profile image
        if ($request->hasFile('profile_image')) {
            $talent->clearMediaCollection('profile');
            $talent->addMediaFromRequest('profile_image')->toMediaCollection('profile');
        }

        // Cover image
        if ($request->hasFile('cover_image')) {
            $talent->clearMediaCollection('cover');
            $talent->addMediaFromRequest('cover_image')->toMediaCollection('cover');
        }

        // If currently draft and fields filled, move to pending for admin approval
        if ($talent->status === 'draft') {
            $data['status'] = 'pending';
        }

        $talent->update($data);

        // Recompute completeness
        $talent->update(['completeness_score' => $talent->computeCompleteness(), 'last_active_at' => now()]);

        return back()->with('success', 'Profile updated successfully!');
    }
}
