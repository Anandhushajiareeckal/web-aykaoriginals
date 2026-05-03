@extends('admin.layouts.app')
@section('title','Model Profiles')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:.75rem">
  <div>
    <p style="font-size:.75rem;color:var(--slate2)">{{ $models->total() }} model portal registrations</p>
  </div>
  <div style="display:flex;gap:.5rem">
    <span class="badge badge-amber" style="font-size:.72rem">{{ $models->where('status','pending')->count() }} pending</span>
    <span class="badge badge-green" style="font-size:.72rem">{{ $models->where('status','approved')->count() }} approved</span>
  </div>
</div>

<div class="panel">
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>Model</th>
          <th>Email</th>
          <th>Status</th>
          <th>Completeness</th>
          <th>Portfolio</th>
          <th>Last Active</th>
          <th>Featured</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($models as $model)
        <tr>
          <td>
            <a href="{{ route('admin.models.show', $model) }}" style="display:flex;align-items:center;gap:.75rem;text-decoration:none">
              @if($model->hasMedia('profile'))
                <img src="{{ $model->getFirstMediaUrl('profile','thumb') }}" style="width:38px;height:38px;border-radius:8px;object-fit:cover;object-position:top;flex-shrink:0">
              @else
                <div class="avatar" style="width:38px;height:38px;font-size:.7rem;border-radius:8px;flex-shrink:0">{{ strtoupper(substr($model->name,0,2)) }}</div>
              @endif
              <div>
                <div style="font-weight:600;font-size:.85rem;color:var(--navy)">{{ $model->name }}</div>
                @if($model->category)<div style="font-size:.7rem;color:var(--slate2)">{{ $model->category }}</div>@endif
                @if($model->location)<div style="font-size:.65rem;color:var(--slate2)">📍 {{ $model->location }}</div>@endif
              </div>
            </a>
          </td>
          <td style="font-size:.78rem;color:var(--slate2)">{{ $model->user?->email ?? '—' }}</td>
          <td>
            <span class="badge {{ match($model->status) { 'approved'=>'badge-green','pending'=>'badge-amber','rejected'=>'badge-red',default=>'badge-slate' } }}">
              {{ ucfirst($model->status) }}
            </span>
          </td>
          <td>
            <div style="display:flex;align-items:center;gap:.5rem">
              <div style="width:60px;height:6px;background:var(--off);border-radius:999px;overflow:hidden;flex-shrink:0">
                <div style="height:100%;width:{{ $model->completeness_score }}%;background:{{ $model->completeness_score >= 80 ? 'var(--green)' : ($model->completeness_score >= 50 ? 'var(--amber)' : 'var(--red)') }};border-radius:999px"></div>
              </div>
              <span style="font-size:.72rem;font-weight:600;color:var(--navy)">{{ $model->completeness_score }}%</span>
            </div>
          </td>
          <td style="font-size:.82rem;color:var(--navy)">{{ $model->getMedia('portfolio')->count() }}</td>
          <td style="font-size:.72rem;color:var(--slate2)">
            {{ $model->last_active_at ? $model->last_active_at->diffForHumans() : 'Never' }}
          </td>
          <td>
            <span class="badge {{ $model->is_featured ? 'badge-purple' : 'badge-slate' }}">{{ $model->is_featured ? 'Featured' : 'No' }}</span>
          </td>
          <td>
            <div style="display:flex;align-items:center;gap:.375rem;flex-wrap:wrap">

              {{-- Inquiries --}}
              <a href="{{ route('admin.models.show', $model) }}" class="btn btn-outline btn-sm" title="View Inquiries" style="white-space:nowrap">
                @php $inqCount = \App\Models\Inquiry::where('talent_id',$model->id)->count() @endphp
                📩 {{ $inqCount }}
              </a>

              {{-- Edit --}}
              <a href="{{ route('admin.models.edit', $model) }}" class="btn btn-outline btn-sm btn-icon" title="Edit Profile">
                <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
              </a>

              {{-- Approve --}}
              @if($model->status !== 'approved')
              <form method="POST" action="{{ route('admin.models.approve',$model) }}">
                @csrf @method('PATCH')
                <button type="submit" class="btn btn-sm" style="background:#dcfce7;color:#16a34a;border:none;white-space:nowrap" title="Approve">✓ Approve</button>
              </form>
              @else
              <span class="badge badge-green" style="white-space:nowrap">✓ Live</span>
              @endif

              {{-- Reject --}}
              @if($model->status !== 'rejected')
              <form method="POST" action="{{ route('admin.models.reject',$model) }}">
                @csrf @method('PATCH')
                <button type="submit" class="btn btn-sm btn-danger" title="Reject" style="white-space:nowrap" onclick="return confirm('Reject {{ addslashes($model->name) }}?')">✕</button>
              </form>
              @endif

              {{-- Feature toggle --}}
              <form method="POST" action="{{ route('admin.models.feature',$model) }}">
                @csrf @method('PATCH')
                <button type="submit" class="btn btn-outline btn-sm btn-icon" title="{{ $model->is_featured ? 'Unfeature' : 'Feature' }}">
                  {{ $model->is_featured ? '★' : '☆' }}
                </button>
              </form>

              {{-- Public profile --}}
              <a href="{{ route('model.show',$model->slug) }}" target="_blank" class="btn btn-outline btn-sm btn-icon" title="View Public Profile">
                <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
              </a>

            </div>
          </td>

        </tr>
        @empty
        <tr>
          <td colspan="8" style="text-align:center;padding:4rem 2rem">
            <div style="font-size:2rem;margin-bottom:.75rem">👤</div>
            <p style="font-weight:600;color:var(--navy);margin-bottom:.5rem">No model registrations yet</p>
            <p style="font-size:.8rem;color:var(--slate2)">Models who register via the portal will appear here for approval.</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($models->hasPages())
  <div style="padding:1rem 1.25rem;border-top:1px solid var(--border)">{{ $models->links() }}</div>
  @endif
</div>

@endsection
