@extends('admin.layouts.app')
@section('title', $project ? 'Edit Project' : 'New Project')
@section('content')
<div style="max-width:800px">
  <form method="POST" action="{{ $project ? route('admin.projects.update',$project) : route('admin.projects.store') }}" enctype="multipart/form-data">
    @csrf @if($project) @method('PUT') @endif
    <div class="admin-card mb-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="md:col-span-2"><label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Brand *</label><input type="text" name="brand" value="{{ old('brand',$project?->brand) }}" required class="admin-input"></div>
        <div><label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Year</label><input type="number" name="year" value="{{ old('year',$project?->year??date('Y')) }}" class="admin-input"></div>
        <div><label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Service Type</label><input type="text" name="service_type" value="{{ old('service_type',$project?->service_type) }}" class="admin-input" placeholder="e.g. Campaign Production"></div>
        <div class="md:col-span-2"><label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Description</label><textarea name="description" rows="4" class="admin-input" style="resize:vertical">{{ old('description',$project?->description) }}</textarea></div>
      </div>
    </div>
    <div class="admin-card mb-4">
      <label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.5rem">Gallery Images</label>
      @if($project && $project->getMedia('gallery')->count())
      <div style="display:flex;flex-wrap:wrap;gap:0.5rem;margin-bottom:0.75rem">
        @foreach($project->getMedia('gallery') as $img)
        <img src="{{ $img->getUrl('thumb') }}" style="height:4rem;width:4rem;object-fit:cover">
        @endforeach
      </div>
      @endif
      <input type="file" name="gallery_images[]" accept="image/*" multiple class="admin-input" style="padding:0.5rem">
    </div>
    <div class="admin-card mb-6">
      <div class="flex gap-6">
        <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-size:0.8rem;color:#5E6472"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$project?->is_active??true)?'checked':'' }}> Active</label>
        <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-size:0.8rem;color:#5E6472"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured',$project?->is_featured)?'checked':'' }}> Featured on Homepage</label>
      </div>
    </div>
    <div class="flex gap-3">
      <button type="submit" class="admin-btn">{{ $project ? 'Update Project' : 'Create Project' }}</button>
      <a href="{{ route('admin.projects.index') }}" class="admin-btn-ghost">Cancel</a>
    </div>
  </form>

  @if($project)
  <form method="POST" action="{{ route('admin.projects.destroy',$project) }}" style="margin-top:-2.2rem;display:flex;justify-content:flex-end" onsubmit="return confirm('Delete?')">
    @csrf @method('DELETE')
    <button type="submit" class="admin-btn-danger">Delete</button>
  </form>
  @endif
</div>
@endsection
