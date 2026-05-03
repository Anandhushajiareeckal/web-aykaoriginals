@extends('model.layouts.app')
@section('title','Dashboard')
@section('content')

@php
  $statusColors = ['draft'=>'badge-slate','pending'=>'badge-amber','approved'=>'badge-green','rejected'=>'badge-red'];
  $statusLabels = ['draft'=>'Draft','pending'=>'Pending Review','approved'=>'Live & Approved','rejected'=>'Rejected'];
@endphp

{{-- ── Welcome banner ── --}}
<div style="background:linear-gradient(135deg,var(--navy) 0%,var(--navy2) 100%);border-radius:16px;padding:2rem;margin-bottom:1.5rem;position:relative;overflow:hidden">
  <div style="position:absolute;top:-30px;right:-30px;width:200px;height:200px;background:radial-gradient(circle,rgba(201,169,110,.15) 0%,transparent 70%);border-radius:50%"></div>
  <div style="position:absolute;bottom:-50px;left:20%;width:250px;height:250px;background:radial-gradient(circle,rgba(108,99,255,.1) 0%,transparent 70%);border-radius:50%"></div>
  <div style="position:relative;z-index:1">
    <p style="font-size:.65rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:.5rem">Welcome back</p>
    <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(1.5rem,3vw,2.25rem);font-weight:400;color:#fff;margin-bottom:1rem">{{ auth()->user()->name }}</h1>
    <div style="display:flex;align-items:center;gap:.75rem;flex-wrap:wrap">
      <span class="badge {{ $statusColors[$stats['status']] ?? 'badge-slate' }}" style="font-size:.7rem;padding:.3rem .875rem">
        {{ $statusLabels[$stats['status']] ?? ucfirst($stats['status']) }}
      </span>
      @if($stats['completeness'] < 80)
      <span style="font-size:.78rem;color:rgba(255,255,255,.55)">Complete your profile to get approved</span>
      @else
      <span style="font-size:.78rem;color:rgba(255,255,255,.55)">Profile looks great!</span>
      @endif
    </div>
  </div>
</div>

{{-- ── Profile Completeness ── --}}
<div class="panel" style="margin-bottom:1.5rem">
  <div class="panel-header">
    <div>
      <span class="panel-title">Profile Completeness</span>
      <p style="font-size:.72rem;color:var(--slate2);margin-top:.2rem">Fill in more details to improve your chances of being featured</p>
    </div>
    <span style="font-size:1.5rem;font-weight:700;color:var(--navy);font-family:'Cormorant Garamond',serif">{{ $stats['completeness'] }}%</span>
  </div>
  <div class="panel-body">
    <div class="completeness-bar">
      <div class="completeness-fill" style="width:{{ $stats['completeness'] }}%"></div>
    </div>
    <div style="display:flex;flex-wrap:wrap;gap:.75rem;margin-top:1.25rem">
      @php
        $checks = [
          ['Profile Photo', $talent?->hasMedia('profile'), route('model.profile.edit')],
          ['Bio / About', !empty($talent?->bio), route('model.profile.edit')],
          ['Location', !empty($talent?->location), route('model.profile.edit')],
          ['Measurements', !empty($talent?->height) && !empty($talent?->waist), route('model.profile.edit')],
          ['Portfolio Images', $stats['portfolio_count'] > 0, route('model.portfolio.index')],
          ['Comp Card', $stats['comp_card_count'] > 0, route('model.comp-card.index')],
          ['Social Links', !empty($talent?->social_links), route('model.profile.edit')],
        ];
      @endphp
      @foreach($checks as [$label, $done, $link])
      <a href="{{ $link }}" style="display:flex;align-items:center;gap:.4rem;padding:.35rem .75rem;border-radius:8px;font-size:.72rem;font-weight:500;border:1px solid;transition:all .2s;{{ $done ? 'border-color:#bbf7d0;background:#f0fdf4;color:#16a34a' : 'border-color:var(--border);background:var(--off);color:var(--slate)' }}">
        @if($done)
        <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
        @else
        <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        @endif
        {{ $label }}
      </a>
      @endforeach
    </div>
  </div>
</div>

{{-- ── Stats Row ── --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:1rem;margin-bottom:1.5rem">

  <div class="stat-card" style="border-top:3px solid var(--accent)">
    <div class="stat-card-icon" style="background:rgba(108,99,255,.1)">
      <svg style="width:1.25rem;height:1.25rem;color:var(--accent)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
    </div>
    <div class="stat-card-value">{{ $stats['portfolio_count'] }}</div>
    <div class="stat-card-label">Portfolio Images</div>
  </div>

  <div class="stat-card" style="border-top:3px solid #C9A96E">
    <div class="stat-card-icon" style="background:rgba(201,169,110,.1)">
      <svg style="width:1.25rem;height:1.25rem;color:#C9A96E" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/></svg>
    </div>
    <div class="stat-card-value">{{ $stats['comp_card_count'] }}</div>
    <div class="stat-card-label">Comp Card Images</div>
  </div>

  <div class="stat-card" style="border-top:3px solid var(--green)">
    <div class="stat-card-icon" style="background:rgba(34,197,94,.1)">
      <svg style="width:1.25rem;height:1.25rem;color:var(--green)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
    <div class="stat-card-value">{{ $stats['completeness'] }}%</div>
    <div class="stat-card-label">Profile Complete</div>
  </div>

  <div class="stat-card" style="border-top:3px solid var(--cyan)">
    <div class="stat-card-icon" style="background:rgba(6,182,212,.1)">
      <svg style="width:1.25rem;height:1.25rem;color:var(--cyan)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
    </div>
    <div class="stat-card-value" style="font-size:1.1rem">
      @if($talent)
      <span style="font-size:.7rem;font-weight:500;letter-spacing:.02em">{{ route('model.show', $talent->slug) }}</span>
      @else —
      @endif
    </div>
    <div class="stat-card-label">Public Profile Link</div>
  </div>

</div>

{{-- ── Quick Actions ── --}}
<div class="panel">
  <div class="panel-header">
    <span class="panel-title">Quick Actions</span>
  </div>
  <div class="panel-body" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem">
    <a href="{{ route('model.profile.edit') }}" style="display:flex;flex-direction:column;align-items:center;gap:.875rem;padding:1.5rem;border:1.5px solid var(--border);border-radius:12px;text-align:center;transition:all .2s;background:#fff" onmouseover="this.style.borderColor='var(--accent)';this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 25px rgba(108,99,255,.1)'" onmouseout="this.style.borderColor='var(--border)';this.style.transform='translateY(0)';this.style.boxShadow='none'">
      <div style="width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center">
        <svg style="width:1.25rem;height:1.25rem;color:#fff" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
      </div>
      <div>
        <div style="font-size:.82rem;font-weight:600;color:var(--navy)">Edit Profile</div>
        <div style="font-size:.7rem;color:var(--slate2);margin-top:.2rem">Update your information</div>
      </div>
    </a>

    <a href="{{ route('model.portfolio.index') }}" style="display:flex;flex-direction:column;align-items:center;gap:.875rem;padding:1.5rem;border:1.5px solid var(--border);border-radius:12px;text-align:center;transition:all .2s;background:#fff" onmouseover="this.style.borderColor='#06B6D4';this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 25px rgba(6,182,212,.1)'" onmouseout="this.style.borderColor='var(--border)';this.style.transform='translateY(0)';this.style.boxShadow='none'">
      <div style="width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,#06B6D4,#22D3EE);display:flex;align-items:center;justify-content:center">
        <svg style="width:1.25rem;height:1.25rem;color:#fff" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
      </div>
      <div>
        <div style="font-size:.82rem;font-weight:600;color:var(--navy)">Upload Photos</div>
        <div style="font-size:.7rem;color:var(--slate2);margin-top:.2rem">Add to your portfolio</div>
      </div>
    </a>

    <a href="{{ route('model.comp-card.index') }}" style="display:flex;flex-direction:column;align-items:center;gap:.875rem;padding:1.5rem;border:1.5px solid var(--border);border-radius:12px;text-align:center;transition:all .2s;background:#fff" onmouseover="this.style.borderColor='#C9A96E';this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 25px rgba(201,169,110,.1)'" onmouseout="this.style.borderColor='var(--border)';this.style.transform='translateY(0)';this.style.boxShadow='none'">
      <div style="width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,#C9A96E,#e8c07a);display:flex;align-items:center;justify-content:center">
        <svg style="width:1.25rem;height:1.25rem;color:#fff" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/></svg>
      </div>
      <div>
        <div style="font-size:.82rem;font-weight:600;color:var(--navy)">Comp Card</div>
        <div style="font-size:.7rem;color:var(--slate2);margin-top:.2rem">Build & download</div>
      </div>
    </a>

    @if($talent)
    <a href="{{ route('model.show', $talent->slug) }}" target="_blank" style="display:flex;flex-direction:column;align-items:center;gap:.875rem;padding:1.5rem;border:1.5px solid var(--border);border-radius:12px;text-align:center;transition:all .2s;background:#fff" onmouseover="this.style.borderColor='#22C55E';this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 25px rgba(34,197,94,.1)'" onmouseout="this.style.borderColor='var(--border)';this.style.transform='translateY(0)';this.style.boxShadow='none'">
      <div style="width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,#22C55E,#4ADE80);display:flex;align-items:center;justify-content:center">
        <svg style="width:1.25rem;height:1.25rem;color:#fff" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
      </div>
      <div>
        <div style="font-size:.82rem;font-weight:600;color:var(--navy)">Public Profile</div>
        <div style="font-size:.7rem;color:var(--slate2);margin-top:.2rem">View how others see you</div>
      </div>
    </a>
    @endif
  </div>
</div>
{{-- ── Approved Inquiries Panel ── --}}
<div class="panel" style="margin-top:1.5rem">
  <div class="panel-header">
    <div>
      <span class="panel-title">📩 Booking Inquiries</span>
      <p style="font-size:.72rem;color:var(--slate2);margin-top:.2rem">Messages from clients — approved by AYKA management</p>
    </div>
    @if($approvedInquiries->count())
    <span class="badge badge-green" style="font-size:.7rem">{{ $approvedInquiries->count() }} {{ Str::plural('inquiry', $approvedInquiries->count()) }}</span>
    @endif
  </div>
  <div class="panel-body" style="padding:0">
    @forelse($approvedInquiries as $inquiry)
    <div style="padding:1.25rem 1.5rem;border-bottom:1px solid var(--border);{{ $loop->last ? 'border-bottom:none' : '' }}">
      <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap">
        <div style="flex:1;min-width:0">
          <div style="display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;margin-bottom:.5rem">
            <div style="width:36px;height:36px;border-radius:8px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;flex-shrink:0">
              <span style="font-size:.8rem;font-weight:700;color:#fff">{{ strtoupper(substr($inquiry->name,0,1)) }}</span>
            </div>
            <div>
              <div style="font-weight:600;font-size:.88rem;color:var(--navy)">{{ $inquiry->name }}</div>
              <div style="font-size:.7rem;color:var(--slate2)">{{ $inquiry->email }}@if($inquiry->company) · {{ $inquiry->company }}@endif</div>
            </div>
          </div>
          <p style="font-size:.85rem;color:var(--slate);line-height:1.7;margin-left:calc(36px + .75rem)">{{ $inquiry->message }}</p>
        </div>
        <div style="text-align:right;flex-shrink:0">
          <div style="font-size:.65rem;color:var(--slate2);white-space:nowrap">{{ $inquiry->created_at->diffForHumans() }}</div>
          @if($inquiry->admin_approved_at)
          <div style="font-size:.6rem;color:#16a34a;margin-top:.25rem">✓ Approved {{ $inquiry->admin_approved_at->format('d M') }}</div>
          @endif
        </div>
      </div>
    </div>
    @empty
    <div style="padding:3rem 1.5rem;text-align:center">
      <div style="font-size:2.5rem;margin-bottom:.75rem">📭</div>
      <p style="font-weight:600;color:var(--navy);margin-bottom:.35rem">No approved inquiries yet</p>
      <p style="font-size:.8rem;color:var(--slate2);max-width:340px;margin:0 auto">When clients contact you through your public profile, AYKA management will review and approve inquiries before they appear here.</p>
    </div>
    @endforelse
  </div>
</div>

@endsection
