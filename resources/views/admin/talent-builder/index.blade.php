@extends('admin.layouts.app')
@section('title', 'Talent Page Builder')
@section('content')

{{-- Flash Messages --}}
@if(session('success'))
<div style="margin-bottom:1.5rem;padding:1rem 1.25rem;background:#F0FDF4;border:1px solid #86EFAC;border-radius:10px;display:flex;align-items:center;gap:.75rem">
    <svg style="width:18px;height:18px;color:#16A34A;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    <span style="font-size:.85rem;color:#15803D;font-weight:500">{{ session('success') }}</span>
</div>
@endif
@if($errors->any())
<div style="margin-bottom:1.5rem;padding:1rem 1.25rem;background:#FEF2F2;border:1px solid #FCA5A5;border-radius:10px">
    <p style="font-size:.85rem;color:#DC2626;font-weight:500;margin-bottom:.5rem">Please fix the following errors:</p>
    <ul style="font-size:.8rem;color:#DC2626;list-style:disc;padding-left:1.2rem">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
</div>
@endif

<div style="margin-bottom:2rem;display:flex;align-items:center;justify-content:space-between">
  <div>
    <h1 style="font-size:1.25rem;font-weight:700;color:#0B132B;font-family:'Cormorant Garamond',serif">Talent Page Builder</h1>
    <p style="font-size:.75rem;color:#8B90A0;margin-top:.25rem">Manage the hero text, stats, and CTA shown on the public Talent index page.</p>
  </div>
  <a href="{{ route('talent.index') }}" target="_blank" style="font-size:.75rem;font-weight:600;padding:.5rem 1.25rem;background:#6C63FF;color:#fff;border-radius:8px;text-decoration:none;display:inline-flex;align-items:center;gap:.5rem">
    <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
    View Live Page
  </a>
</div>

<div style="max-width:900px;display:flex;flex-direction:column;gap:1.5rem">

  {{-- ── HERO SECTION ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#6C63FF0d">
      <div style="width:10px;height:10px;border-radius:50%;background:#6C63FF"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">Hero Section</span>
    </div>
    <div style="padding:1.5rem">
      <form method="POST" action="{{ route('admin.talent-builder.section.update', 'hero') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Main Heading</label>
            <input type="text" name="heading" value="{{ $sections['hero']->heading ?? 'The Talent Behind the Work' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Italic Subheading (Styled Text)</label>
            <input type="text" name="subheading" value="{{ $sections['hero']->subheading ?? 'Meet the Extraordinary.' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div style="grid-column:1/-1">
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Hero Body Text</label>
            <textarea name="body" rows="2" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">{{ $sections['hero']->body ?? 'We represent the world\'s next generation of cultural icons — models, influencers, and creative visionaries who shape culture and commerce.' }}</textarea>
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Upload Hero Background Image</label>
            <input type="file" name="image_file" accept="image/*" style="width:100%;padding:.5rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
            @if(!empty($sections['hero']->image_url))
              <div style="margin-top:.5rem;display:flex;align-items:center;gap:.5rem">
                <img src="{{ $sections['hero']->image_url }}" style="height:50px;width:80px;object-fit:cover;border-radius:4px;border:1px solid #E4E6F0">
                <span style="font-size:.7rem;color:#8B90A0">Current image</span>
              </div>
            @endif
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Or Upload Background Video <span style="text-transform:none;letter-spacing:0;color:#8B90A0;font-weight:400">— overrides image</span></label>
            <input type="file" name="video_file" accept="video/mp4" style="width:100%;padding:.5rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Or Paste Video URL</label>
            <input type="text" name="video_url" value="{{ $sections['hero']->video_url ?? '' }}" placeholder="https://..." style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
        </div>
        <button type="submit" style="background:#6C63FF;color:#fff;padding:.55rem 1.25rem;border:none;border-radius:8px;cursor:pointer;font-size:.8rem;font-weight:600">Save Hero Section</button>
      </form>
    </div>
  </div>

  {{-- ── STATS SECTION ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#10B9810d">
      <div style="width:10px;height:10px;border-radius:50%;background:#10B981"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">Stats Bar (Animated Numbers)</span>
      <span style="font-size:.7rem;color:#8B90A0;margin-left:auto">Shown below the header</span>
    </div>
    <div style="padding:1.5rem;display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
      @foreach([
        ['stat_1', 'Stat 1 (e.g. 120+)', 'Campaigns Delivered'],
        ['stat_2', 'Stat 2 (e.g. 40+)', 'Brand Partnerships'],
        ['stat_3', 'Stat 3 (e.g. 6)', 'Talents Represented'],
        ['stat_4', 'Stat 4 (e.g. 3)', 'Countries Active'],
      ] as [$key, $numLabel, $defaultLabel])
      <div style="background:#F8F9FB;border-radius:10px;padding:1rem;border:1px solid #E4E6F0">
        <p style="font-size:.65rem;font-weight:700;color:#5E6472;letter-spacing:.1em;text-transform:uppercase;margin-bottom:.75rem">{{ $numLabel }}</p>
        <form method="POST" action="{{ route('admin.talent-builder.section.update', $key) }}" enctype="multipart/form-data">
          @csrf
          <div style="margin-bottom:.75rem">
            <label style="display:block;font-size:.65rem;color:#8B90A0;margin-bottom:.3rem">Number Value (e.g. 120+)</label>
            <input type="text" name="heading" value="{{ optional($sections[$key] ?? null)->heading ?? '' }}" placeholder="e.g. 120+" style="width:100%;padding:.5rem;border:1.5px solid #E4E6F0;border-radius:6px;font-size:.8rem;color:#0B132B">
          </div>
          <div style="margin-bottom:.75rem">
            <label style="display:block;font-size:.65rem;color:#8B90A0;margin-bottom:.3rem">Label Text</label>
            <input type="text" name="subheading" value="{{ optional($sections[$key] ?? null)->subheading ?? $defaultLabel }}" style="width:100%;padding:.5rem;border:1.5px solid #E4E6F0;border-radius:6px;font-size:.8rem;color:#0B132B">
          </div>
          <button type="submit" style="background:#10B981;color:#fff;padding:.4rem 1rem;border:none;border-radius:6px;cursor:pointer;font-size:.7rem;font-weight:600">Save Stat</button>
        </form>
      </div>
      @endforeach
    </div>
  </div>

  {{-- ── CTA SECTION ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#F59E0B0d">
      <div style="width:10px;height:10px;border-radius:50%;background:#F59E0B"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">Roster Intro Text</span>
      <span style="font-size:.7rem;color:#8B90A0;margin-left:auto">Shown above talent grid</span>
    </div>
    <div style="padding:1.5rem">
      <form method="POST" action="{{ route('admin.talent-builder.section.update', 'roster') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Heading</label>
            <input type="text" name="heading" value="{{ $sections['roster']->heading ?? 'Meet the Extraordinary.' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Button Label</label>
            <input type="text" name="btn1_label" value="{{ $sections['roster']->btn1_label ?? 'Apply to Join' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Button URL</label>
            <input type="text" name="btn1_url" value="{{ $sections['roster']->btn1_url ?? '/contact' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
        </div>
        <button type="submit" style="background:#F59E0B;color:#fff;padding:.55rem 1.25rem;border:none;border-radius:8px;cursor:pointer;font-size:.8rem;font-weight:600">Save Roster Section</button>
      </form>
    </div>
  </div>

</div>
@endsection
