@extends('model.layouts.app')
@section('title','Settings')
@section('content')
<style>
.mobile-only{display:none;}
@media(max-width:900px){
  .settings-grid{grid-template-columns:1fr !important}
  .btn{width:100%;justify-content:center}
  .mobile-only{display:block !important;}
}
</style>
<div class="settings-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;align-items:start">

  {{-- Mobile Only: Edit Profile Link --}}
  <div class="panel mobile-only" style="grid-column:1/-1;">
    <a href="{{ route('model.profile.edit') }}" style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem;text-decoration:none;color:var(--navy)">
      <div style="display:flex;align-items:center;gap:.75rem">
        <div style="width:40px;height:40px;border-radius:10px;background:var(--off);display:flex;align-items:center;justify-content:center;color:var(--accent)">
          <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <div>
          <div style="font-weight:600;font-size:.95rem">Edit Profile Details</div>
          <div style="font-size:.75rem;color:var(--slate2);margin-top:.15rem">Update your measurements, bio, and info</div>
        </div>
      </div>
      <svg style="width:1rem;height:1rem;color:var(--slate2)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </a>
  </div>

  {{-- Account Info --}}
  <div class="panel">
    <div class="panel-header"><span class="panel-title">Account Information</span></div>
    <div class="panel-body">
      <form method="POST" action="{{ route('model.settings.update') }}">
        @csrf @method('PUT')
        <div class="form-group">
          <label class="form-label">Full Name</label>
          <input type="text" name="name" value="{{ old('name',$user->name) }}" required class="form-control">
          @error('name')<p style="color:var(--red);font-size:.72rem;margin-top:.3rem">{{ $message }}</p>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Email Address</label>
          <input type="email" name="email" value="{{ old('email',$user->email) }}" required class="form-control">
          @error('email')<p style="color:var(--red);font-size:.72rem;margin-top:.3rem">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </form>
    </div>
  </div>

  {{-- Change Password --}}
  <div class="panel">
    <div class="panel-header"><span class="panel-title">Change Password</span></div>
    <div class="panel-body">
      <form method="POST" action="{{ route('model.settings.password') }}">
        @csrf @method('PUT')
        <div class="form-group">
          <label class="form-label">Current Password</label>
          <input type="password" name="current_password" required class="form-control">
          @error('current_password')<p style="color:var(--red);font-size:.72rem;margin-top:.3rem">{{ $message }}</p>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">New Password</label>
          <input type="password" name="password" required class="form-control" placeholder="At least 8 characters">
          @error('password')<p style="color:var(--red);font-size:.72rem;margin-top:.3rem">{{ $message }}</p>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Confirm New Password</label>
          <input type="password" name="password_confirmation" required class="form-control">
        </div>
        <button type="submit" class="btn btn-outline">Update Password</button>
      </form>
    </div>
  </div>

  {{-- Profile Visibility --}}
  @if($talent)
  <div class="panel">
    <div class="panel-header"><span class="panel-title">Profile Visibility</span></div>
    <div class="panel-body">
      <div style="display:flex;align-items:center;justify-content:space-between;padding:.875rem;border:1px solid var(--border);border-radius:10px;background:var(--off);margin-bottom:1rem">
        <div>
          <p style="font-weight:600;font-size:.85rem;color:var(--navy)">Public Profile</p>
          <p style="font-size:.72rem;color:var(--slate2);margin-top:.25rem">When active, your profile appears on the agency roster</p>
        </div>
        <form method="POST" action="{{ route('model.settings.visibility') }}">
          @csrf @method('PATCH')
          <input type="hidden" name="is_active" value="{{ $talent->is_active ? '0' : '1' }}">
          <button type="submit" style="width:44px;height:24px;border-radius:999px;border:none;cursor:pointer;position:relative;transition:background .2s;background:{{ $talent->is_active ? '#22C55E' : '#E4E6F0' }}">
            <span style="position:absolute;top:2px;{{ $talent->is_active ? 'right:2px' : 'left:2px' }};width:20px;height:20px;border-radius:50%;background:#fff;display:block;transition:all .2s"></span>
          </button>
        </form>
      </div>
      <p style="font-size:.72rem;color:var(--slate2)">
        ⚠️ Your profile must be approved by an admin to appear publicly, regardless of this setting.
      </p>
    </div>
  </div>

  {{-- Share Profile --}}
  <div class="panel">
    <div class="panel-header"><span class="panel-title">Share Your Profile</span></div>
    <div class="panel-body">
      <p style="font-size:.8rem;color:var(--slate2);margin-bottom:1rem">Share your public profile link with clients and casting directors.</p>
      @if($talent->status === 'approved')
      <div style="display:flex;gap:.5rem;margin-bottom:1rem">
        <input type="text" id="share-url" value="{{ route('talent.show',$talent->slug) }}" readonly class="form-control" style="font-size:.75rem;color:var(--slate)">
        <button onclick="copyShare()" class="btn btn-outline" style="flex-shrink:0">Copy</button>
      </div>
      <a href="{{ route('talent.show',$talent->slug) }}" target="_blank" class="btn btn-primary btn-sm">
        View Public Profile ↗
      </a>
      @else
      <div style="background:var(--off);border:1px solid var(--border);border-radius:10px;padding:1rem;font-size:.78rem;color:var(--slate2)">
        🔒 Your profile link will be available once approved by our team.
      </div>
      @endif
    </div>
  </div>
  @endif

</div>

@endsection
@push('scripts')
<script>
function copyShare() {
  const url = document.getElementById('share-url');
  url.select();
  document.execCommand('copy');
  const btn = url.nextElementSibling;
  btn.textContent = 'Copied!';
  setTimeout(() => btn.textContent = 'Copy', 2000);
}
</script>
@endpush
