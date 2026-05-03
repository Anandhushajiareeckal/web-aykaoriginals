@extends('model.layouts.app')
@section('title','Edit Profile')
@section('content')
<style>
@media(max-width:900px){
  .profile-outer{grid-template-columns:1fr !important}
  .profile-inner-grid{grid-template-columns:1fr !important}
  .profile-sidebar{display:none}
  .btn{width:100%;justify-content:center;margin-bottom:.5rem}
}
</style>
<div class="profile-outer" style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start" x-data="profilePreview()">

  {{-- ── Main Form ── --}}
  <div>
    <form id="profile-form" method="POST" action="{{ route('model.profile.update') }}" enctype="multipart/form-data">
      @csrf @method('PUT')

      {{-- Basic Info --}}
      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-header">
          <span class="panel-title">Basic Information</span>
          <span class="badge badge-slate">Required for approval</span>
        </div>
        <div class="panel-body">
          <div class="profile-inner-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
            <div class="form-group">
              <label class="form-label">Full Name *</label>
              <input type="text" name="name" value="{{ old('name',$talent->name) }}" required class="form-control" placeholder="Your professional name" x-model="name">
              @error('name')<p style="color:var(--red);font-size:.72rem;margin-top:.3rem">{{ $message }}</p>@enderror
            </div>
            <div class="form-group" x-data="{ 
                slug: '{{ old('slug',$talent->slug) }}', 
                available: true, 
                loading: false, 
                error: '',
                check() {
                    if (this.slug.length < 3) return;
                    this.loading = true;
                    fetch('{{ route('model.profile.check-slug') }}?slug=' + this.slug)
                        .then(r => r.json())
                        .then(data => {
                            this.available = data.available;
                            this.slug = data.slug;
                            this.error = data.error || '';
                            this.loading = false;
                        });
                }
            }">
              <label class="form-label">Username / Public URL *</label>
              <div style="display:flex;align-items:center;position:relative">
                <span style="padding:0 .75rem;font-size:.7rem;color:var(--slate2);background:var(--off);border:1.5px solid var(--border);border-right:none;border-radius:8px 0 0 8px;height:42px;display:flex;align-items:center;white-space:nowrap">ayka.com/model/</span>
                <input type="text" name="slug" x-model="slug" @input.debounce.500ms="check()" required class="form-control" style="border-radius:0 8px 8px 0;flex:1;height:42px" placeholder="yourname">
                <div style="position:absolute;right:10px;top:50%;transform:translateY(-50%)">
                    <template x-if="loading"><span>⏳</span></template>
                    <template x-if="!loading && slug.length >= 3">
                        <span x-text="available ? '✅' : '❌'"></span>
                    </template>
                </div>
              </div>
              <p x-show="!available" style="color:var(--red);font-size:.72rem;margin-top:.3rem" x-text="error || 'This username is already taken'"></p>
              <p style="font-size:.65rem;color:var(--slate2);margin-top:.3rem">Your profile address: <strong>ayka.com/model/<span x-text="slug"></span></strong></p>
              @error('slug')<p style="color:var(--red);font-size:.72rem;margin-top:.3rem">{{ $message }}</p>@enderror
            </div>
            <div class="form-group">
              <label class="form-label">Category</label>
              <input type="text" name="category" value="{{ old('category',$talent->category) }}" class="form-control" placeholder="Fashion, Editorial, Commercial…" x-model="category">
            </div>
            <div class="form-group">
              <label class="form-label">Gender</label>
              <select name="gender" class="form-control">
                <option value="">Select gender</option>
                @foreach(['female'=>'Female','male'=>'Male','non-binary'=>'Non-Binary','other'=>'Other'] as $v=>$l)
                <option value="{{ $v }}" {{ old('gender',$talent->gender)===$v?'selected':'' }}>{{ $l }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Location</label>
              <input type="text" name="location" value="{{ old('location',$talent->location) }}" class="form-control" placeholder="City, Country" x-model="location">
            </div>
          </div>
          <div class="form-group" style="margin-top:1.5rem; margin-bottom:0">
            <label class="form-label">Bio / About Me</label>
            <textarea name="bio" class="form-control" rows="4" placeholder="Tell your story — experience, style, aspirations…" x-model="bio">{{ old('bio',$talent->bio) }}</textarea>
          </div>
        </div>
      </div>

      {{-- Measurements --}}
      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-header"><span class="panel-title">Measurements</span></div>
        <div class="panel-body">
          <div class="profile-inner-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem">
            @foreach([
              ['Height','height','e.g. 5\'9" / 175cm'],
              ['Chest / Bust','chest_bust','e.g. 34" / 86cm'],
              ['Waist','waist','e.g. 24" / 61cm'],
              ['Hips','hips','e.g. 35" / 89cm'],
              ['Weight','weight','e.g. 55 kg'],
              ['Inseam','inseam','e.g. 32" / 81cm'],
              ['Shoe Size','shoe_size','e.g. US 8 / EU 38'],
              ['Eye Color','eye_color','e.g. Brown'],
              ['Hair Color','hair_color','e.g. Dark Brown'],
            ] as [$label,$name,$ph])
            <div class="form-group" style="margin-bottom:0">
              <label class="form-label">{{ $label }}</label>
              <input type="text" name="{{ $name }}" value="{{ old($name,$talent->$name) }}" class="form-control" placeholder="{{ $ph }}">
            </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- Social Links --}}
      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-header"><span class="panel-title">Social Media Links</span></div>
        <div class="panel-body">
          <div class="profile-inner-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            @foreach([
              ['instagram','Instagram','@yourhandle'],
              ['facebook','Facebook','facebook.com/yourname'],
              ['tiktok','TikTok','@yourtiktok'],
              ['twitter','Twitter / X','@yourtwitter'],
            ] as [$key,$label,$ph])
            <div class="form-group" style="margin-bottom:0">
              <label class="form-label">{{ $label }}</label>
              <div style="display:flex;align-items:center;border:1.5px solid var(--border);border-radius:8px;overflow:hidden;background:#fff;transition:border-color .2s" onfocusin="this.style.borderColor='var(--accent)'" onfocusout="this.style.borderColor='var(--border)'">
                <span style="padding:0 .875rem;font-size:.8rem;color:var(--slate2);border-right:1px solid var(--border);height:100%;display:flex;align-items:center;background:var(--off)">
                  @if($key==='instagram')📸@elseif($key==='facebook')👤@elseif($key==='tiktok')🎵@else🐦@endif
                </span>
                <input type="text" name="social_{{ $key }}" value="{{ old('social_'.$key, $talent->social_links[$key] ?? '') }}" placeholder="{{ $ph }}" style="border:none;padding:.625rem .875rem;font-size:.85rem;color:var(--navy);flex:1;outline:none;font-family:'Inter',sans-serif;background:transparent">
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- Images --}}
      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-header"><span class="panel-title">Profile & Cover Images</span></div>
        <div class="panel-body">
          <div class="profile-inner-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
            {{-- Profile photo --}}
            <div>
              <label class="form-label">Profile Photo</label>
              @if($talent->hasMedia('profile'))
              <div style="margin-bottom:.75rem;position:relative;display:inline-block">
                <img src="{{ $talent->getFirstMediaUrl('profile','medium') }}" style="height:120px;width:90px;border-radius:10px;object-fit:cover;object-position:top">
                <div style="position:absolute;top:-6px;right:-6px;width:20px;height:20px;border-radius:50%;background:var(--green);display:flex;align-items:center;justify-content:center">
                  <svg style="width:.65rem;height:.65rem;color:#fff" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
              </div>
              @endif
              <div style="border:2px dashed var(--border);border-radius:10px;padding:1.25rem;text-align:center;cursor:pointer;transition:all .2s;background:var(--off);position:relative" onmouseover="this.style.borderColor='var(--accent)';this.style.background='rgba(108,99,255,.03)'" onmouseout="this.style.borderColor='var(--border)';this.style.background='var(--off)'">
                <svg style="width:1.5rem;height:1.5rem;color:var(--slate2);margin:0 auto .5rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                <p style="font-size:.75rem;color:var(--slate);font-weight:500">Click to upload profile photo</p>
                <p style="font-size:.65rem;color:var(--slate2);margin-top:.25rem">JPG, PNG, WebP · Max 5MB</p>
                <input type="file" name="profile_image" accept="image/*" style="position:absolute;inset:0;opacity:0;cursor:pointer" onchange="previewImage(this,'profile-preview')">
              </div>
              <img id="profile-preview" src="" style="display:none;height:80px;width:60px;object-fit:cover;border-radius:8px;margin-top:.75rem">
            </div>

            {{-- Cover image --}}
            <div>
              <label class="form-label">Cover / Banner Image</label>
              @if($talent->hasMedia('cover'))
              <div style="margin-bottom:.75rem">
                <img src="{{ $talent->getFirstMediaUrl('cover','medium') }}" style="height:80px;width:100%;border-radius:10px;object-fit:cover">
              </div>
              @endif
              <div style="border:2px dashed var(--border);border-radius:10px;padding:1.25rem;text-align:center;cursor:pointer;transition:all .2s;background:var(--off);position:relative" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                <svg style="width:1.5rem;height:1.5rem;color:var(--slate2);margin:0 auto .5rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p style="font-size:.75rem;color:var(--slate);font-weight:500">Upload cover banner</p>
                <p style="font-size:.65rem;color:var(--slate2);margin-top:.25rem">Recommended: 1600×600px</p>
                <input type="file" name="cover_image" accept="image/*" style="position:absolute;inset:0;opacity:0;cursor:pointer">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div style="display:flex;align-items:center;gap:.75rem">
        <button type="submit" class="btn btn-primary">
          <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          Save Profile
        </button>
        <a href="{{ route('model.dashboard') }}" class="btn btn-outline">Cancel</a>
        @if($talent->status === 'draft')
        <span style="margin-left:auto;font-size:.72rem;color:var(--slate2)">
          💡 Saving will submit your profile for admin review
        </span>
        @endif
      </div>
    </form>
  </div>

  {{-- ── Live Preview ── --}}
  <div class="profile-sidebar" style="position:sticky;top:80px">
    <div class="panel">
      <div class="panel-header"><span class="panel-title">Live Preview</span></div>
      <div class="panel-body" style="padding:0">
        {{-- Profile card preview --}}
        <div style="background:linear-gradient(160deg,var(--navy),var(--navy2));padding:1.5rem;border-radius:0 0 0 0">
          @if($talent->hasMedia('profile'))
          <img src="{{ $talent->getFirstMediaUrl('profile','medium') }}" style="width:80px;height:100px;object-fit:cover;object-position:top;border-radius:8px;margin-bottom:.875rem;display:block" id="preview-img">
          @else
          <div style="width:80px;height:100px;background:rgba(255,255,255,.1);border-radius:8px;margin-bottom:.875rem;display:flex;align-items:center;justify-content:center">
            <span style="font-family:'Cormorant Garamond',serif;font-size:2rem;color:rgba(255,255,255,.4)" x-text="name.charAt(0) || '?'"></span>
          </div>
          @endif
          <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.25rem;font-weight:400;color:#fff" x-text="name || '{{ $talent->name }}'"></h3>
          <p style="font-size:.65rem;letter-spacing:.2em;text-transform:uppercase;color:rgba(255,255,255,.45);margin-top:.3rem" x-text="category || '{{ $talent->category }}'"></p>
          <p style="font-size:.72rem;color:rgba(255,255,255,.4);margin-top:.35rem" x-text="location || '{{ $talent->location }}'"></p>
        </div>
        <div style="padding:1.25rem">
          <p style="font-size:.7rem;color:var(--slate2);line-height:1.7;margin-bottom:1rem" x-text="bio || '{{ addslashes(Str::limit($talent->bio ?? 'Your bio will appear here...', 120)) }}'"></p>
          @if($talent->slug)
          <a href="{{ route('model.show',$talent->slug) }}" target="_blank" class="btn btn-outline btn-sm" style="width:100%;justify-content:center">
            View Public Profile ↗
          </a>
          @endif
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
@push('scripts')
<script>
function profilePreview() {
  return {
    name: '{{ addslashes($talent->name) }}',
    category: '{{ addslashes($talent->category ?? '') }}',
    location: '{{ addslashes($talent->location ?? '') }}',
    bio: '{{ addslashes(Str::limit($talent->bio ?? '', 200)) }}',
  }
}
function previewImage(input, previewId) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const img = document.getElementById(previewId);
      if (img) { img.src = e.target.result; img.style.display = 'block'; }
      // Also update the preview card
      const previewImg = document.getElementById('preview-img');
      if (previewImg) previewImg.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endpush
