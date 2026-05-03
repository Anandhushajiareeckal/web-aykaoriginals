@extends('admin.layouts.app')
@section('title','Pages')
@section('content')
<div class="flex items-center justify-between mb-6">
  <div></div>
  <a href="{{ route('admin.pages.create') }}" class="admin-btn">+ New Page</a>
</div>
<div class="admin-card" style="padding:0;overflow:hidden">
  <table style="width:100%;border-collapse:collapse">
    <thead style="background:#F8F8FA">
      <tr>
        @foreach(['Title','Slug','Template','Status','Sort','Actions'] as $h)
        <th style="padding:0.75rem 1rem;text-align:left;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;font-weight:500">{{ $h }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @forelse($pages as $page)
      <tr style="border-top:1px solid #E2E4EA">
        <td style="padding:0.75rem 1rem;font-size:0.85rem;font-weight:500;color:#0B132B">{{ $page->title }}</td>
        <td style="padding:0.75rem 1rem;font-size:0.8rem;color:#5E6472">/pages/{{ $page->slug }}</td>
        <td style="padding:0.75rem 1rem;font-size:0.8rem;color:#5E6472">{{ $page->template }}</td>
        <td style="padding:0.75rem 1rem"><span class="{{ $page->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $page->is_active ? 'Active' : 'Draft' }}</span></td>
        <td style="padding:0.75rem 1rem;font-size:0.8rem;color:#5E6472">{{ $page->sort_order }}</td>
        <td style="padding:0.75rem 1rem">
          <div class="flex gap-2">
            <a href="{{ route('admin.pages.edit',$page) }}" class="admin-btn-ghost" style="padding:0.3rem 0.75rem;font-size:0.65rem">Edit</a>
            <a href="{{ route('page.show',$page->slug) }}" target="_blank" class="admin-btn-ghost" style="padding:0.3rem 0.75rem;font-size:0.65rem">View</a>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="6" style="padding:2rem;text-align:center;color:#5E6472">No pages yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
