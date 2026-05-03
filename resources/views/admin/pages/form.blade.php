@extends('admin.layouts.app')
@section('title', $page ? 'Edit Page' : 'New Page')
@section('content')

<div style="display:grid;grid-template-columns:1fr;gap:1.5rem;max-width:1000px" class="lg:grid-cols-3">

  <div style="grid-column:span 2" class="lg:col-span-2">
    <form method="POST" action="{{ $page ? route('admin.pages.update',$page) : route('admin.pages.store') }}">
      @csrf @if($page) @method('PUT') @endif

      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-header"><span class="panel-title">Page Details</span></div>
        <div class="panel-body">
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem" class="sm:grid-cols-2">
            <div class="form-group">
              <label class="form-label">Page Title *</label>
              <input type="text" name="title" value="{{ old('title',$page?->title) }}" required class="form-control">
            </div>
            <div class="form-group">
              <label class="form-label">Template</label>
              <select name="template" class="form-control">
                @foreach(['default'=>'Default','about'=>'About','services'=>'Services','gallery'=>'Gallery','blog'=>'Blog','contact'=>'Contact'] as $v=>$l)
                <option value="{{ $v }}" {{ old('template',$page?->template)===$v?'selected':'' }}>{{ $l }}</option>
                @endforeach
              </select>
            </div>
            @if(!$page)
            <div class="form-group">
              <label class="form-label">Slug (auto if empty)</label>
              <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="my-page-url">
            </div>
            @endif
            <div class="form-group">
              <label class="form-label">Sort Order</label>
              <input type="number" name="sort_order" value="{{ old('sort_order',$page?->sort_order??0) }}" class="form-control">
            </div>
          </div>
        </div>
      </div>

      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-header">
          <span class="panel-title">Page Content</span>
          <span style="font-size:.7rem;color:var(--slate2)">HTML supported</span>
        </div>
        <div class="panel-body">
          <textarea id="content" name="content" rows="18" class="form-control" style="font-family:'Courier New',monospace;font-size:.82rem;line-height:1.7">{{ old('content',$page?->content) }}</textarea>
        </div>
      </div>

      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-header"><span class="panel-title">SEO Settings</span></div>
        <div class="panel-body">
          <div class="form-group">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title',$page?->meta_title) }}" class="form-control">
          </div>
          <div class="form-group" style="margin-bottom:0">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" rows="2" class="form-control">{{ old('meta_description',$page?->meta_description) }}</textarea>
          </div>
        </div>
      </div>

      <div style="display:flex;align-items:center;gap:.75rem">
        <button type="submit" class="btn btn-primary">
          <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          {{ $page ? 'Update Page' : 'Create Page' }}
        </button>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline">Cancel</a>
        @if($page)
        <form method="POST" action="{{ route('admin.pages.destroy',$page) }}" style="margin-left:auto" onsubmit="return confirm('Delete this page?')">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete Page</button>
        </form>
        @endif
      </div>
    </form>
  </div>

  <div>
    <div class="panel">
      <div class="panel-header"><span class="panel-title">Publish Settings</span></div>
      <div class="panel-body">
        <label style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.5rem;cursor:pointer">
          <span style="font-size:.82rem;font-weight:500;color:var(--navy)">Published</span>
          <input type="checkbox" name="is_active" value="1" {{ old('is_active',$page?->is_active??true)?'checked':'' }} style="width:1rem;height:1rem;accent-color:var(--accent)">
        </label>
        @if($page)
        <div class="divider"></div>
        <a href="{{ route('page.show',$page->slug) }}" target="_blank" class="btn btn-outline" style="width:100%;justify-content:center">
          View Live Page
        </a>
        @endif
      </div>
    </div>
  </div>

</div>
@endsection
