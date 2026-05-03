@extends('admin.layouts.app')
@section('title','Gallery')
@section('content')
<div class="admin-card mb-6">
  <h3 style="font-family:'Cormorant Garamond',serif;font-size:1rem;color:#0B132B;margin-bottom:1.25rem">Upload Images</h3>
  <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
      <div>
        <label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Category</label>
        <input type="text" name="category" class="admin-input" placeholder="e.g. Editorial, Campaign">
      </div>
      <div>
        <label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Caption (optional)</label>
        <input type="text" name="title" class="admin-input" placeholder="Image caption">
      </div>
      <div>
        <label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Images *</label>
        <input type="file" name="images[]" accept="image/*" multiple required class="admin-input" style="padding:0.5rem">
      </div>
    </div>
    <button type="submit" class="admin-btn">Upload Images</button>
  </form>
</div>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:1rem">
  @forelse($items as $item)
  <div style="position:relative;overflow:hidden">
    @if($item->hasMedia('image'))
    <img src="{{ $item->getFirstMediaUrl('image','thumb') }}" style="width:100%;aspect-ratio:1;object-fit:cover">
    @endif
    <div style="padding:0.5rem;background:#fff;border:1px solid #E2E4EA;border-top:0">
      <p style="font-size:0.7rem;color:#5E6472;margin-bottom:0.25rem">{{ $item->category }}</p>
      <form method="POST" action="{{ route('admin.gallery.destroy',$item) }}" onsubmit="return confirm('Delete?')">
        @csrf @method('DELETE')
        <button type="submit" style="font-size:0.65rem;color:#dc2626;letter-spacing:0.1em;text-transform:uppercase;background:none;border:none;cursor:pointer;padding:0">Delete</button>
      </form>
    </div>
  </div>
  @empty
  <div style="grid-column:1/-1;padding:3rem;text-align:center;color:#5E6472">No images uploaded yet.</div>
  @endforelse
</div>
@if($items->hasPages())<div style="margin-top:1.5rem">{{ $items->links() }}</div>@endif
@endsection
