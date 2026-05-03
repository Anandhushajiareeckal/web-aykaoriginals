@extends('admin.layouts.app')
@section('title', $talent->name . ' — Inquiries')
@section('content')

{{-- Back + Header --}}
<div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.75rem;flex-wrap:wrap">
  <a href="{{ route('admin.models.index') }}" class="btn btn-outline btn-sm">← All Models</a>
  <div style="display:flex;align-items:center;gap:.875rem">
    @if($talent->hasMedia('profile'))
      <img src="{{ $talent->getFirstMediaUrl('profile','thumb') }}" style="width:52px;height:52px;border-radius:10px;object-fit:cover;object-position:top">
    @else
      <div class="avatar" style="width:52px;height:52px;font-size:.9rem;border-radius:10px">{{ strtoupper(substr($talent->name,0,2)) }}</div>
    @endif
    <div>
      <h2 style="font-size:1.1rem;font-weight:700;color:var(--navy)">{{ $talent->name }}</h2>
      <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-top:.3rem">
        <span class="badge {{ match($talent->status) { 'approved'=>'badge-green','pending'=>'badge-amber','rejected'=>'badge-red',default=>'badge-slate' } }}">{{ ucfirst($talent->status) }}</span>
        @if($talent->category)<span class="badge badge-blue">{{ $talent->category }}</span>@endif
        @if($talent->location)<span style="font-size:.7rem;color:var(--slate2)">📍 {{ $talent->location }}</span>@endif
      </div>
    </div>
  </div>
  <div style="margin-left:auto;display:flex;gap:.5rem;flex-wrap:wrap">
    @if($talent->status !== 'approved')
    <form method="POST" action="{{ route('admin.models.approve',$talent) }}">@csrf @method('PATCH')
      <button type="submit" class="btn btn-sm" style="background:#dcfce7;color:#16a34a;border:none">✓ Approve Model</button>
    </form>
    @endif
    <a href="{{ route('model.show',$talent->slug) }}" target="_blank" class="btn btn-outline btn-sm">View Public Profile ↗</a>
  </div>
</div>

{{-- Stats row --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.75rem">
  @php
    $total   = $inquiries->total();
    $approved = \App\Models\Inquiry::where('talent_id',$talent->id)->where('admin_approved',true)->count();
    $pending  = \App\Models\Inquiry::where('talent_id',$talent->id)->where('admin_approved',false)->count();
    $newCount = \App\Models\Inquiry::where('talent_id',$talent->id)->where('status','new')->count();
  @endphp
  <div class="stat-card">
    <div class="stat-card-icon" style="background:#ede9fe"><svg style="width:1.25rem;height:1.25rem;color:#7c3aed" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
    <div class="stat-card-value">{{ $total }}</div>
    <div class="stat-card-label">Total Inquiries</div>
  </div>
  <div class="stat-card">
    <div class="stat-card-icon" style="background:#dcfce7"><svg style="width:1.25rem;height:1.25rem;color:#16a34a" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
    <div class="stat-card-value">{{ $approved }}</div>
    <div class="stat-card-label">Approved (Visible to Model)</div>
  </div>
  <div class="stat-card">
    <div class="stat-card-icon" style="background:#fef3c7"><svg style="width:1.25rem;height:1.25rem;color:#d97706" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
    <div class="stat-card-value">{{ $pending }}</div>
    <div class="stat-card-label">Awaiting Approval</div>
  </div>
  <div class="stat-card">
    <div class="stat-card-icon" style="background:#dbeafe"><svg style="width:1.25rem;height:1.25rem;color:#2563eb" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg></div>
    <div class="stat-card-value">{{ $newCount }}</div>
    <div class="stat-card-label">New / Unread</div>
  </div>
</div>

{{-- Inquiries Table --}}
<div class="panel">
  <div class="panel-header">
    <span class="panel-title">Booking Inquiries for {{ $talent->name }}</span>
    <span style="font-size:.72rem;color:var(--slate2)">Approve inquiries to make them visible on the model's dashboard</span>
  </div>
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>From</th>
          <th>Message</th>
          <th>Received</th>
          <th>Status</th>
          <th>Visibility</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($inquiries as $inquiry)
        <tr style="{{ $inquiry->admin_approved ? '' : 'opacity:.75' }}">
          <td>
            <div style="font-weight:600;font-size:.85rem;color:var(--navy)">{{ $inquiry->name }}</div>
            <div style="font-size:.72rem;color:var(--slate2)">{{ $inquiry->email }}</div>
            @if($inquiry->company)<div style="font-size:.68rem;color:var(--slate2)">{{ $inquiry->company }}</div>@endif
          </td>
          <td style="max-width:300px">
            <p style="font-size:.8rem;color:var(--navy);line-height:1.5;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical">{{ $inquiry->message }}</p>
          </td>
          <td style="font-size:.72rem;color:var(--slate2);white-space:nowrap">{{ $inquiry->created_at->diffForHumans() }}</td>
          <td>
            <span class="badge {{ match($inquiry->status) { 'new'=>'badge-amber','read'=>'badge-blue','replied'=>'badge-green',default=>'badge-slate' } }}">
              {{ ucfirst($inquiry->status) }}
            </span>
          </td>
          <td>
            @if($inquiry->admin_approved)
              <span class="badge badge-green" title="Approved on {{ $inquiry->admin_approved_at?->format('d M Y H:i') }}">✓ Approved</span>
            @else
              <span class="badge badge-slate">Hidden from model</span>
            @endif
          </td>
          <td>
            <div style="display:flex;align-items:center;gap:.375rem">
              <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-outline btn-sm">View</a>
              <form method="POST" action="{{ route('admin.models.inquiry.approve', [$talent, $inquiry]) }}">
                @csrf @method('PATCH')
                @if($inquiry->admin_approved)
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Revoke approval? The model will no longer see this inquiry.')">Revoke</button>
                @else
                  <button type="submit" class="btn btn-sm" style="background:#dcfce7;color:#16a34a;border:none">✓ Approve</button>
                @endif
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" style="text-align:center;padding:4rem 2rem">
            <div style="font-size:2.5rem;margin-bottom:.75rem">📭</div>
            <p style="font-weight:600;color:var(--navy);margin-bottom:.35rem">No inquiries yet</p>
            <p style="font-size:.8rem;color:var(--slate2)">When clients submit a booking inquiry from this model's public profile, it will appear here.</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($inquiries->hasPages())
  <div style="padding:1rem 1.25rem;border-top:1px solid var(--border)">{{ $inquiries->links() }}</div>
  @endif
</div>

@endsection
