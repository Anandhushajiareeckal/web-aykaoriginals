@extends('admin.layouts.app')
@section('title','Blog / Journal')
@section('content')
<div class="flex items-center justify-between mb-6">
  <div></div>
  <a href="{{ route('admin.blog.create') }}" class="admin-btn">+ New Post</a>
</div>
<div class="admin-card" style="padding:0;overflow:hidden">
  <table style="width:100%;border-collapse:collapse">
    <thead style="background:#F8F8FA"><tr>
      @foreach(['Title','Category','Status','Published','Actions'] as $h)
      <th style="padding:0.75rem 1rem;text-align:left;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;font-weight:500">{{ $h }}</th>
      @endforeach
    </tr></thead>
    <tbody>
      @forelse($posts as $post)
      <tr style="border-top:1px solid #E2E4EA">
        <td style="padding:0.75rem 1rem;font-size:0.85rem;font-weight:500;color:#0B132B">{{ $post->title }}</td>
        <td style="padding:0.75rem 1rem;font-size:0.8rem;color:#5E6472">{{ $post->category }}</td>
        <td style="padding:0.75rem 1rem"><span class="{{ $post->is_active ? 'badge-active' : 'badge-draft' }}">{{ $post->is_active ? 'Published' : 'Draft' }}</span></td>
        <td style="padding:0.75rem 1rem;font-size:0.8rem;color:#5E6472">{{ $post->published_at?->format('M d, Y') }}</td>
        <td style="padding:0.75rem 1rem"><a href="{{ route('admin.blog.edit',$post) }}" class="admin-btn-ghost" style="padding:0.3rem 0.75rem;font-size:0.65rem">Edit</a></td>
      </tr>
      @empty
      <tr><td colspan="5" style="padding:2rem;text-align:center;color:#5E6472">No posts yet. <a href="{{ route('admin.blog.create') }}" style="color:#0B132B;text-decoration:underline">Write the first one.</a></td></tr>
      @endforelse
    </tbody>
  </table>
  @if($posts->hasPages())<div style="padding:1rem;border-top:1px solid #E2E4EA">{{ $posts->links() }}</div>@endif
</div>
@endsection
