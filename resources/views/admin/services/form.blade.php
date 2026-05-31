@extends('admin.layouts.app')
@section('title', $service ? 'Edit Service' : 'New Service')
@section('content')
<div style="max-width:700px">
  @if(session('success'))
  <div style="margin-bottom:1.25rem;padding:.875rem 1rem;background:#F0FDF4;border:1px solid #86EFAC;border-radius:8px;font-size:.82rem;color:#15803D;font-weight:500">{{ session('success') }}</div>
  @endif
  @if($errors->any())
  <div style="margin-bottom:1.25rem;padding:.875rem 1rem;background:#FEF2F2;border:1px solid #FCA5A5;border-radius:8px">
    <ul style="font-size:.8rem;color:#DC2626;list-style:disc;padding-left:1.2rem">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
  @endif

  <form method="POST" action="{{ $service ? route('admin.services.update',$service) : route('admin.services.store') }}" enctype="multipart/form-data">
    @csrf @if($service) @method('PUT') @endif
    <div class="admin-card mb-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

        {{-- Title --}}
        <div class="md:col-span-2">
          <label style="display:block;font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Title *</label>
          <input type="text" name="title" value="{{ old('title',$service?->title) }}" required class="admin-input">
        </div>

        {{-- Tag (pill label on card) --}}
        <div>
          <label style="display:block;font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Card Tag Label</label>
          <input type="text" name="tag" value="{{ old('tag',$service?->tag) }}" class="admin-input" placeholder="e.g. Talent, Campaign, Branding">
          <p style="font-size:.7rem;color:#8B90A0;margin-top:.3rem">Short label shown as badge on the service card.</p>
        </div>

        {{-- Icon --}}
        <div>
          <label style="display:block;font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Icon Key</label>
          <input type="text" name="icon" value="{{ old('icon',$service?->icon) }}" class="admin-input" placeholder="star | camera | edit | briefcase">
          <p style="font-size:.7rem;color:#8B90A0;margin-top:.3rem">Used as fallback when no image is uploaded.</p>
        </div>

        {{-- Image Upload --}}
        <div class="md:col-span-2">
          <label style="display:block;font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Service Cover Image</label>
          <input type="file" name="image_file" accept="image/*" class="admin-input" style="padding:.5rem">
          @if($service?->image_url)
          <div style="margin-top:.75rem;display:flex;align-items:center;gap:.75rem">
            <img src="{{ $service->image_url }}" style="height:60px;width:110px;object-fit:cover;border-radius:6px;border:1px solid #E4E6F0">
            <div>
              <span style="font-size:.72rem;color:#8B90A0;display:block">Current image</span>
              <a href="{{ $service->image_url }}" target="_blank" style="font-size:.68rem;color:#6C63FF">View full →</a>
            </div>
          </div>
          @endif
        </div>

        {{-- Banner Upload --}}
        <div class="md:col-span-2">
          <label style="display:block;font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Service Detail Banner Image (for detailed page)</label>
          <input type="file" name="banner_file" accept="image/*" class="admin-input" style="padding:.5rem">
          @if($service?->banner_image)
          <div style="margin-top:.75rem;display:flex;align-items:center;gap:.75rem">
            <img src="{{ $service->banner_image }}" style="height:60px;width:150px;object-fit:cover;border-radius:6px;border:1px solid #E4E6F0">
            <div>
              <span style="font-size:.72rem;color:#8B90A0;display:block">Current banner</span>
              <a href="{{ $service->banner_image }}" target="_blank" style="font-size:.68rem;color:#6C63FF">View full →</a>
            </div>
          </div>
          @endif
        </div>

        {{-- Description --}}
        <div class="md:col-span-2">
          <label style="display:block;font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Short Description</label>
          <textarea name="description" rows="3" class="admin-input" style="resize:vertical">{{ old('description',$service?->description) }}</textarea>
        </div>

        {{-- Content --}}
        <div class="md:col-span-2">
          <label style="display:block;font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Full Content (Rich Text)</label>
          <textarea name="content" id="summernote">{{ old('content', $service?->content) }}</textarea>
        </div>

        {{-- Sort Order --}}
        <div>
          <label style="display:block;font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Sort Order</label>
          <input type="number" name="sort_order" value="{{ old('sort_order',$service?->sort_order??0) }}" class="admin-input">
        </div>

        {{-- Active --}}
        <div style="display:flex;align-items:center">
          <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;font-size:.82rem;color:#5E6472;margin-top:1.5rem">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active',$service?->is_active??true)?'checked':'' }}>
            Active (visible on site)
          </label>
        </div>

      </div>
    </div>

    <div class="flex gap-3">
      <button type="submit" class="admin-btn">{{ $service ? 'Save Changes' : 'Create Service' }}</button>
      <a href="{{ route('admin.services.index') }}" class="admin-btn-ghost">Cancel</a>
    </div>
  </form>

  @if($service)
  <form id="delete-form" method="POST" action="{{ route('admin.services.destroy',$service) }}" class="mt-4 text-right" onsubmit="return confirm('Delete this service permanently?')">
    @csrf @method('DELETE')
    <button type="submit" class="admin-btn-danger">Delete Service</button>
  </form>
  @endif
</div>
@endsection

@push('scripts')
{{-- Summernote Lite (no Bootstrap dependency) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
<style>
.note-editor.note-frame { border: 1.5px solid #E4E6F0; border-radius: 8px; overflow: hidden; font-family: 'Inter', sans-serif; }
.note-editable { min-height: 420px !important; font-size: 15px; background: #0B132B !important; color: #fff !important; padding: 1.25rem !important; }
.note-toolbar { background: #f8f9fa !important; border-bottom: 1px solid #E4E6F0 !important; flex-wrap: wrap; }
.note-toolbar .note-btn { font-size: 12px; }
.note-popover { z-index: 9999 !important; }
.note-dropdown-menu { z-index: 9999 !important; display: none; }
.note-dropdown-menu.show { display: block !important; }
</style>
<script>
$(document).ready(function() {
    $('#summernote').summernote({
        height: 450,
        placeholder: 'Write the full service description here...',
        toolbar: [
            ['style',   ['style']],
            ['font',    ['bold','italic','underline','strikethrough','clear']],
            ['color',   ['color']],
            ['para',    ['ul','ol','paragraph']],
            ['table',   ['table']],
            ['insert',  ['link','picture','hr']],
            ['view',    ['fullscreen','codeview','help']]
        ]
    });
});
</script>
@endpush
