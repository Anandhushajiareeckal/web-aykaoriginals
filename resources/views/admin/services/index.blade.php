@extends('admin.layouts.app')
@section('title','Services')
@section('content')
<div class="flex items-center justify-between mb-6"><div></div><a href="{{ route('admin.services.create') }}" class="admin-btn">+ Add Service</a></div>
<div class="admin-card" style="padding:0;overflow:hidden">
  <table style="width:100%;border-collapse:collapse">
    <thead style="background:#F8F8FA"><tr>
      @foreach(['#','Title','Description','Status','Actions'] as $h)
      <th style="padding:0.75rem 1rem;text-align:left;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;font-weight:500">{{ $h }}</th>
      @endforeach
    </tr></thead>
    <tbody>
      @forelse($services as $s)
      <tr style="border-top:1px solid #E2E4EA">
        <td style="padding:0.75rem 1rem;font-size:0.8rem;color:#8B90A0">{{ $s->sort_order }}</td>
        <td style="padding:0.75rem 1rem;font-size:0.85rem;font-weight:500;color:#0B132B">{{ $s->title }}</td>
        <td style="padding:0.75rem 1rem;font-size:0.8rem;color:#5E6472;max-width:300px">{{ Str::limit($s->description,80) }}</td>
        <td style="padding:0.75rem 1rem"><span class="{{ $s->is_active?'badge-active':'badge-inactive' }}">{{ $s->is_active?'Active':'Inactive' }}</span></td>
        <td style="padding:0.75rem 1rem"><a href="{{ route('admin.services.edit',$s) }}" class="admin-btn-ghost" style="padding:0.3rem 0.75rem;font-size:0.65rem">Edit</a></td>
      </tr>
      @empty<tr><td colspan="5" style="padding:2rem;text-align:center;color:#5E6472">No services yet.</td></tr>@endforelse
    </tbody>
  </table>
</div>
@endsection
