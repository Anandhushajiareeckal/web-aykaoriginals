@extends('admin.layouts.app')
@section('title','Talent')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:.75rem">
  <div>
    <p style="font-size:.75rem;color:var(--slate2)">{{ $talents->total() }} talent profiles</p>
  </div>
  <a href="{{ route('admin.talent.create') }}" class="btn btn-primary">
    <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Add Talent
  </a>
</div>

<div class="panel">
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>Talent</th>
          <th>Category</th>
          <th>Gender</th>
          <th>Location</th>
          <th>Status</th>
          <th>Featured</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($talents as $talent)
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:.75rem">
              @if($talent->hasMedia('profile'))
                <img src="{{ $talent->getFirstMediaUrl('profile','thumb') }}" style="width:38px;height:38px;border-radius:8px;object-fit:cover;object-position:top;flex-shrink:0">
              @else
                <div class="avatar" style="width:38px;height:38px;font-size:.7rem;border-radius:8px;flex-shrink:0">{{ strtoupper(substr($talent->name,0,2)) }}</div>
              @endif
              <div>
                <div style="font-weight:600;font-size:.85rem;color:var(--navy)">{{ $talent->name }}</div>
                @if($talent->height)<div style="font-size:.7rem;color:var(--slate2)">{{ $talent->height }}</div>@endif
              </div>
            </div>
          </td>
          <td><span class="tag">{{ $talent->category ?: '—' }}</span></td>
          <td style="font-size:.8rem;color:var(--slate)">{{ ucfirst($talent->gender) ?: '—' }}</td>
          <td style="font-size:.78rem;color:var(--slate2)">{{ $talent->location ?: '—' }}</td>
          <td><span class="badge {{ $talent->is_active ? 'badge-green' : 'badge-slate' }}">{{ $talent->is_active ? 'Active' : 'Inactive' }}</span></td>
          <td><span class="badge {{ $talent->is_featured ? 'badge-purple' : 'badge-slate' }}">{{ $talent->is_featured ? 'Featured' : 'No' }}</span></td>
          <td>
            <div style="display:flex;align-items:center;gap:.375rem">
              <a href="{{ route('admin.talent.edit',$talent) }}" class="btn btn-outline btn-sm btn-icon" title="Edit">
                <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
              </a>
              <a href="{{ route('talent.show',$talent->slug) }}" target="_blank" class="btn btn-outline btn-sm btn-icon" title="View">
                <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
              </a>
              <form action="{{ route('admin.talent.destroy', $talent) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this talent?');" style="margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline btn-sm btn-icon" title="Delete" style="color:#ef4444;border-color:#fee2e2">
                  <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" style="text-align:center;padding:4rem 2rem">
            <div style="font-size:2rem;margin-bottom:.75rem">👤</div>
            <p style="font-weight:600;color:var(--navy);margin-bottom:.5rem">No talent yet</p>
            <p style="font-size:.8rem;color:var(--slate2);margin-bottom:1rem">Add your first talent profile to get started</p>
            <a href="{{ route('admin.talent.create') }}" class="btn btn-primary">Add First Talent</a>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($talents->hasPages())
  <div style="padding:1rem 1.25rem;border-top:1px solid var(--border)">{{ $talents->links() }}</div>
  @endif
</div>
@endsection
