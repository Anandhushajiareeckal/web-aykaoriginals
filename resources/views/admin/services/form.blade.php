@extends('admin.layouts.app')
@section('title', $service ? 'Edit Service' : 'New Service')
@section('content')
<div style="max-width:700px">
  <form method="POST" action="{{ $service ? route('admin.services.update',$service) : route('admin.services.store') }}">
    @csrf @if($service) @method('PUT') @endif
    <div class="admin-card mb-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="md:col-span-2"><label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Title *</label><input type="text" name="title" value="{{ old('title',$service?->title) }}" required class="admin-input"></div>
        <div><label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Icon</label><input type="text" name="icon" value="{{ old('icon',$service?->icon) }}" class="admin-input" placeholder="e.g. star, camera, edit"></div>
        <div><label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order',$service?->sort_order??0) }}" class="admin-input"></div>
        <div class="md:col-span-2"><label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Short Description</label><textarea name="description" rows="3" class="admin-input" style="resize:vertical">{{ old('description',$service?->description) }}</textarea></div>
        <div class="md:col-span-2"><label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Full Content (HTML)</label><textarea name="content" rows="8" class="admin-input" style="resize:vertical;font-family:monospace;font-size:0.85rem">{{ old('content',$service?->content) }}</textarea></div>
      </div>
      <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-size:0.8rem;color:#5E6472"><input type="checkbox" name="is_active" value="1" {{ old('is_active',$service?->is_active??true)?'checked':'' }}> Active</label>
    </div>
    <div class="flex gap-3">
      <button type="submit" class="admin-btn">{{ $service ? 'Update' : 'Create' }}</button>
      <a href="{{ route('admin.services.index') }}" class="admin-btn-ghost">Cancel</a>
      @if($service)
      <form method="POST" action="{{ route('admin.services.destroy',$service) }}" style="margin-left:auto" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="admin-btn-danger">Delete</button></form>
      @endif
    </div>
  </form>
</div>
@endsection
