@extends('admin.layouts.app')
@section('title', $talent ? 'Edit Talent' : 'Add Talent')
@section('content')

<form id="talent-form" method="POST" action="{{ $talent ? route('admin.talent.update',$talent) : route('admin.talent.store') }}" enctype="multipart/form-data">
  @csrf
  @if($talent) @method('PUT') @endif
<div style="display:grid;grid-template-columns:1fr;gap:1.5rem;max-width:1000px" class="lg:grid-cols-3">

  <!-- Main Form -->
  <div style="grid-column:span 2" class="lg:col-span-2">
    

      <!-- Basic Info -->
      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-header">
          <span class="panel-title">Basic Information</span>
        </div>
        <div class="panel-body">
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem" class="sm:grid-cols-2">
            <div class="form-group">
              <label class="form-label">Full Name *</label>
              <input type="text" name="name" value="{{ old('name',$talent?->name) }}" required class="form-control" placeholder="Model's full name">
            </div>
            <div class="form-group">
              <label class="form-label">Category</label>
              <input type="text" name="category" value="{{ old('category',$talent?->category) }}" class="form-control" placeholder="Fashion, Editorial...">
            </div>
            <div class="form-group">
              <label class="form-label">Gender</label>
              <select name="gender" class="form-control">
                <option value="">Select gender</option>
                @foreach(['female'=>'Female','male'=>'Male','non-binary'=>'Non-Binary'] as $v=>$l)
                <option value="{{ $v }}" {{ old('gender',$talent?->gender)===$v?'selected':'' }}>{{ $l }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Location</label>
              <input type="text" name="location" value="{{ old('location',$talent?->location) }}" class="form-control" placeholder="City, Country">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Biography</label>
            <textarea name="bio" class="form-control" rows="4" placeholder="Short biography...">{{ old('bio',$talent?->bio) }}</textarea>
          </div>
        </div>
      </div>

      <!-- Measurements -->
      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-header"><span class="panel-title">Measurements</span></div>
        <div class="panel-body">
          <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1rem" class="sm:grid-cols-3 lg:grid-cols-4">
            @foreach([['Height','height'],['Chest/Bust','chest_bust'],['Waist','waist'],['Hips','hips'],['Shoe Size','shoe_size'],['Eye Color','eye_color'],['Hair Color','hair_color']] as [$l,$n])
            <div class="form-group" style="margin-bottom:0">
              <label class="form-label">{{ $l }}</label>
              <input type="text" name="{{ $n }}" value="{{ old($n,$talent?->{$n}) }}" class="form-control" placeholder="{{ $l }}">
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Images -->
      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-header"><span class="panel-title">Images</span></div>
        <div class="panel-body">
          @if($talent && $talent->hasMedia('profile'))
          <div style="margin-bottom:1rem">
            <label class="form-label">Current Profile Photo</label>
            <img src="{{ $talent->getFirstMediaUrl('profile','medium') }}" style="height:120px;border-radius:8px;object-fit:cover">
          </div>
          @endif
          <div class="form-group">
            <label class="form-label">Profile Photo</label>
            <input type="file" name="profile_image" accept="image/*" class="form-control" style="padding:.5rem">
          </div>
          <div class="form-group" style="margin-bottom:0">
            <label class="form-label">Portfolio Images (multiple)</label>
            <input type="file" name="portfolio_images[]" accept="image/*" multiple class="form-control" style="padding:.5rem">
          </div>
          @if($talent && $talent->getMedia('portfolio')->count())
          <div style="display:flex;flex-wrap:wrap;gap:.5rem;margin-top:1rem">
            @foreach($talent->getMedia('portfolio') as $img)
            <div style="position:relative;display:inline-block;">
              <img src="{{ $img->getUrl('thumb') }}" style="width:64px;height:64px;object-fit:cover;border-radius:6px">
              <button type="button" onclick="if(confirm('Delete this image?')){ document.getElementById('delete-image-{{ $img->id }}').submit(); }" class="btn btn-danger btn-sm" style="position:absolute;top:-6px;right:-6px;width:20px;height:20px;min-height:20px;padding:0;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:background 0.2s;" title="Delete image">&times;</button>
            </div>
            @endforeach
          </div>
          @endif
        </div>
      </div>

      <div style="display:flex;align-items:center;gap:.75rem">
        <button type="submit" class="btn btn-primary">
          <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          {{ $talent ? 'Update Talent' : 'Create Talent' }}
        </button>
        <a href="{{ route('admin.talent.index') }}" class="btn btn-outline">Cancel</a>
        @if($talent)
          <button type="submit" form="delete-talent-form" class="btn btn-danger" style="margin-left:auto" onclick="return confirm('Delete this talent?')">
            <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            Delete
          </button>
        @endif
      </div>
  </div>

  <!-- Sidebar Panel -->
  <div>
    <div class="panel" style="margin-bottom:1.25rem">
      <div class="panel-header"><span class="panel-title">Visibility</span></div>
      <div class="panel-body" style="display:flex;flex-direction:column;gap:.875rem">
        <label style="display:flex;align-items:center;justify-content:space-between;cursor:pointer">
          <span style="font-size:.82rem;font-weight:500;color:var(--navy)">Active</span>
          <input type="checkbox" name="is_active" value="1" {{ old('is_active',$talent?->is_active??true) ? 'checked' : '' }} style="width:1rem;height:1rem;accent-color:var(--accent)">
        </label>
        <label style="display:flex;align-items:center;justify-content:space-between;cursor:pointer">
          <span style="font-size:.82rem;font-weight:500;color:var(--navy)">Featured on Homepage</span>
          <input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$talent?->is_featured) ? 'checked' : '' }} style="width:1rem;height:1rem;accent-color:var(--accent)">
        </label>
      </div>
    </div>
    @if($talent)
    <div class="panel">
      <div class="panel-header"><span class="panel-title">Preview</span></div>
      <div class="panel-body" style="text-align:center">
        @if($talent->hasMedia('profile'))
        <img src="{{ $talent->getFirstMediaUrl('profile','medium') }}" style="width:100%;border-radius:8px;object-fit:cover;aspect-ratio:2/3;margin-bottom:.75rem">
        @endif
        <p style="font-weight:600;color:var(--navy);font-family:'Cormorant Garamond',serif;font-size:1.1rem">{{ $talent->name }}</p>
        <p style="font-size:.75rem;color:var(--slate2);margin-top:.25rem">{{ $talent->category }}</p>
        <a href="{{ route('talent.show',$talent->slug) }}" target="_blank" class="btn btn-outline btn-sm" style="margin-top:.875rem;width:100%;justify-content:center">View Public Profile</a>
      </div>
    </div>
    @endif
  </div>
</div>
</form>

@if($talent)
<form id="delete-talent-form" method="POST" action="{{ route('admin.talent.destroy',$talent) }}">
  @csrf @method('DELETE')
</form>
@foreach($talent->getMedia('portfolio') as $img)
<form id="delete-image-{{ $img->id }}" method="POST" action="{{ route('admin.talent.image.delete', [$talent, $img->id]) }}">
  @csrf @method('DELETE')
</form>
@endforeach
@endif
@endsection
