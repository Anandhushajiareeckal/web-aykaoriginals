@extends('admin.layouts.app')
@section('title', 'About Page Builder')
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

<div style="max-width:900px">

  {{-- ── HERO SECTION ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden;margin-bottom:1.5rem">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#6C63FF0d">
      <div style="width:10px;height:10px;border-radius:50%;background:#6C63FF"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">Hero Section</span>
    </div>
    <div style="padding:1.5rem">
      <form method="POST" action="{{ route('admin.about.section.update', 'hero') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Main Heading</label>
            <input type="text" name="heading" value="{{ $sections['hero']->heading ?? 'About AYKA Originals' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Upload Background Image</label>
            <input type="file" name="image_file" accept="image/*" style="width:100%;padding:.5rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
            @if(!empty($sections['hero']->image_url))
            <div style="margin-top:.5rem;display:flex;align-items:center;gap:.5rem">
                <img src="{{ $sections['hero']->image_url }}" style="height:50px;width:80px;object-fit:cover;border-radius:4px;border:1px solid #E4E6F0">
                <span style="font-size:.7rem;color:#8B90A0">Current image</span>
            </div>
            @endif
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Upload Background Video (MP4) <span style="text-transform:none;letter-spacing:0;color:#8B90A0;font-weight:400">— overrides image</span></label>
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

  {{-- ── MISSION SECTION ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden;margin-bottom:1.5rem">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#8B5CF60d">
      <div style="width:10px;height:10px;border-radius:50%;background:#8B5CF6"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">Mission / Story Block 1</span>
    </div>
    <div style="padding:1.5rem">
      <form method="POST" action="{{ route('admin.about.section.update', 'mission') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Heading</label>
            <input type="text" name="heading" value="{{ $sections['mission']->heading ?? '' }}" placeholder="e.g. Defining the New Standard." style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Upload Image (Left Side)</label>
            <input type="file" name="image_file" accept="image/*" style="width:100%;padding:.5rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem">
            @if(!empty($sections['mission']->image_url))
            <div style="margin-top:.5rem;display:flex;align-items:center;gap:.5rem">
                <img src="{{ $sections['mission']->image_url }}" style="height:60px;width:50px;object-fit:cover;border-radius:4px;border:1px solid #E4E6F0">
                <div>
                    <span style="font-size:.7rem;color:#8B90A0;display:block">Current image</span>
                    <a href="{{ $sections['mission']->image_url }}" target="_blank" style="font-size:.65rem;color:#6C63FF">View full →</a>
                </div>
            </div>
            @endif
          </div>
          <div style="grid-column:1/-1">
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Body Text</label>
            <textarea name="body" rows="4" placeholder="Describe your mission..." style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem">{{ $sections['mission']->body ?? '' }}</textarea>
          </div>
        </div>
        <button type="submit" style="background:#8B5CF6;color:#fff;padding:.55rem 1.25rem;border:none;border-radius:8px;cursor:pointer;font-size:.8rem;font-weight:600">Save Mission Block</button>
      </form>
    </div>
  </div>

  {{-- ── VISION SECTION ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden;margin-bottom:1.5rem">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#0ea5e90d">
      <div style="width:10px;height:10px;border-radius:50%;background:#0ea5e9"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">Vision / Story Block 2</span>
    </div>
    <div style="padding:1.5rem">
      <form method="POST" action="{{ route('admin.about.section.update', 'vision') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Heading</label>
            <input type="text" name="heading" value="{{ $sections['vision']->heading ?? '' }}" placeholder="e.g. Shaping Culture." style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Upload Image (Right Side)</label>
            <input type="file" name="image_file" accept="image/*" style="width:100%;padding:.5rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem">
            @if(!empty($sections['vision']->image_url))
            <div style="margin-top:.5rem;display:flex;align-items:center;gap:.5rem">
                <img src="{{ $sections['vision']->image_url }}" style="height:50px;width:80px;object-fit:cover;border-radius:4px;border:1px solid #E4E6F0">
                <div>
                    <span style="font-size:.7rem;color:#8B90A0;display:block">Current image</span>
                    <a href="{{ $sections['vision']->image_url }}" target="_blank" style="font-size:.65rem;color:#6C63FF">View full →</a>
                </div>
            </div>
            @endif
          </div>
          <div style="grid-column:1/-1">
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Body Text</label>
            <textarea name="body" rows="4" placeholder="Describe your vision..." style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem">{{ $sections['vision']->body ?? '' }}</textarea>
          </div>
        </div>
        <button type="submit" style="background:#0ea5e9;color:#fff;padding:.55rem 1.25rem;border:none;border-radius:8px;cursor:pointer;font-size:.8rem;font-weight:600">Save Vision Block</button>
      </form>
    </div>
  </div>

  {{-- ── CTA SECTION ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden;margin-bottom:1.5rem">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#F59E0B0d">
      <div style="width:10px;height:10px;border-radius:50%;background:#F59E0B"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">CTA Section (Call to Action)</span>
    </div>
    <div style="padding:1.5rem">
      <form method="POST" action="{{ route('admin.about.section.update', 'cta') }}">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Heading</label>
            <input type="text" name="heading" value="{{ $sections['cta']->heading ?? 'Ready to Collaborate?' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Button Label</label>
            <input type="text" name="btn1_label" value="{{ $sections['cta']->btn1_label ?? 'Join Us' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem">
          </div>
        </div>
        <p style="font-size:.75rem;color:#8B90A0;margin-bottom:1rem">The button links to the Contact/Inquiry page automatically.</p>
        <button type="submit" style="background:#F59E0B;color:#fff;padding:.55rem 1.25rem;border:none;border-radius:8px;cursor:pointer;font-size:.8rem;font-weight:600">Save CTA</button>
      </form>
    </div>
  </div>

</div>
@endsection
