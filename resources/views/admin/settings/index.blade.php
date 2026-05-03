@extends('admin.layouts.app')
@section('title','Site Settings')
@section('content')

<form method="POST" action="{{ route('admin.settings.update') }}">
  @csrf
  <div style="display:grid;grid-template-columns:1fr;gap:1.5rem;max-width:900px" class="lg:grid-cols-2">

    <div>
      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-header">
          <span class="panel-title">Brand Identity</span>
          <span style="width:8px;height:8px;border-radius:50%;background:#6C63FF;display:inline-block"></span>
        </div>
        <div class="panel-body">
          @foreach([['site_name','Site Name','text'],['site_tagline','Tagline','text'],['site_email','Booking Email','email'],['site_phone','Phone Number','text'],['site_address','Address / Location','text']] as [$k,$l,$t])
          <div class="form-group">
            <label class="form-label">{{ $l }}</label>
            <input type="{{ $t }}" name="{{ $k }}" value="{{ $settings[$k]->value ?? '' }}" class="form-control">
          </div>
          @endforeach
        </div>
      </div>

      <div class="panel">
        <div class="panel-header">
          <span class="panel-title">Social Media</span>
          <span style="width:8px;height:8px;border-radius:50%;background:#06B6D4;display:inline-block"></span>
        </div>
        <div class="panel-body">
          @foreach([['instagram_url','Instagram URL'],['linkedin_url','LinkedIn URL']] as [$k,$l])
          <div class="form-group">
            <label class="form-label">{{ $l }}</label>
            <input type="url" name="{{ $k }}" value="{{ $settings[$k]->value ?? '#' }}" class="form-control">
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div>
      <div class="panel" style="margin-bottom:1.25rem">
        <div class="panel-header">
          <span class="panel-title">Homepage Content</span>
          <span style="width:8px;height:8px;border-radius:50%;background:#22C55E;display:inline-block"></span>
        </div>
        <div class="panel-body">
          @foreach([['hero_heading','Hero Heading','text'],['hero_subheading','Hero Sub-Heading','text'],['hero_body','Hero Body Text','textarea']] as [$k,$l,$t])
          <div class="form-group">
            <label class="form-label">{{ $l }}</label>
            @if($t==='textarea')
            <textarea name="{{ $k }}" rows="3" class="form-control">{{ $settings[$k]->value ?? '' }}</textarea>
            @else
            <input type="text" name="{{ $k }}" value="{{ $settings[$k]->value ?? '' }}" class="form-control">
            @endif
          </div>
          @endforeach
        </div>
      </div>

      <div class="panel">
        <div class="panel-header">
          <span class="panel-title">About &amp; Footer</span>
          <span style="width:8px;height:8px;border-radius:50%;background:#F59E0B;display:inline-block"></span>
        </div>
        <div class="panel-body">
          @foreach([['about_heading','About Section Heading','text'],['about_body','About Body Text','textarea'],['footer_text','Footer Description','textarea']] as [$k,$l,$t])
          <div class="form-group">
            <label class="form-label">{{ $l }}</label>
            @if($t==='textarea')
            <textarea name="{{ $k }}" rows="3" class="form-control">{{ $settings[$k]->value ?? '' }}</textarea>
            @else
            <input type="text" name="{{ $k }}" value="{{ $settings[$k]->value ?? '' }}" class="form-control">
            @endif
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div style="margin-top:1.5rem;max-width:900px">
    <button type="submit" class="btn btn-primary" style="padding:.75rem 2rem">
      <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
      Save All Settings
    </button>
  </div>
</form>
@endsection
