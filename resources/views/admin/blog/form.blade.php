@extends('admin.layouts.app')
@section('title', $post ? 'Edit Post' : 'New Post')
@section('content')
<div style="max-width:900px">
  <form method="POST" action="{{ $post ? route('admin.blog.update',$post) : route('admin.blog.store') }}" enctype="multipart/form-data">
    @csrf
    @if($post) @method('PUT') @endif
    <div class="admin-card mb-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="md:col-span-2">
          <label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Title *</label>
          <input type="text" name="title" value="{{ old('title',$post?->title) }}" required class="admin-input" placeholder="Post title">
        </div>
        <div>
          <label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Category</label>
          <input type="text" name="category" value="{{ old('category',$post?->category) }}" class="admin-input" placeholder="e.g. Industry News">
        </div>
        <div>
          <label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Published Date</label>
          <input type="date" name="published_at" value="{{ old('published_at', $post?->published_at?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" class="admin-input">
        </div>
        <div class="md:col-span-2">
          <label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.4rem">Excerpt</label>
          <textarea name="excerpt" rows="2" class="admin-input" style="resize:vertical" placeholder="Short summary...">{{ old('excerpt',$post?->excerpt) }}</textarea>
        </div>
      </div>
    </div>
    <div class="admin-card mb-4">
      <label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.75rem">Content (HTML supported)</label>
      <textarea name="content" rows="16" class="admin-input" style="resize:vertical;font-family:monospace;font-size:0.85rem">{{ old('content',$post?->content) }}</textarea>
    </div>
    <div class="admin-card mb-4">
      <label style="display:block;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;margin-bottom:0.5rem">Cover Image</label>
      @if($post && $post->hasMedia('cover'))
      <img src="{{ $post->getFirstMediaUrl('cover','medium') }}" style="height:6rem;margin-bottom:0.75rem;object-fit:cover">
      @endif
      <input type="file" name="cover" accept="image/*" class="admin-input" style="padding:0.5rem">
    </div>
    <div class="admin-card mb-6">
      <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-size:0.8rem;color:#5E6472">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active',$post?->is_active??true) ? 'checked' : '' }}> Published
      </label>
    </div>
    <div class="flex gap-3">
      <button type="submit" class="admin-btn">{{ $post ? 'Update Post' : 'Publish Post' }}</button>
      <a href="{{ route('admin.blog.index') }}" class="admin-btn-ghost">Cancel</a>
      @if($post)
      <form method="POST" action="{{ route('admin.blog.destroy',$post) }}" style="margin-left:auto" onsubmit="return confirm('Delete this post?')">
        @csrf @method('DELETE')
        <button type="submit" class="admin-btn-danger">Delete</button>
      </form>
      @endif
    </div>
  </form>
</div>
@endsection
