@extends('admin.layouts.app')
@section('title', 'Service Page Builder')
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

<div class="mb-6 flex items-center justify-between">
  <div>
    <h1 class="text-xl font-bold text-[#0B132B] font-serif">Service Page Builder</h1>
    <p class="text-xs text-gray-500 mt-1">Manage the hero section and overall content for the Services index page.</p>
  </div>
  <a href="{{ route('services.index') }}" target="_blank" class="text-xs font-semibold px-4 py-2 bg-[#6C63FF] text-white rounded-lg shadow hover:bg-[#5a52d5] transition-colors">
    View Live Page
  </a>
</div>

<div style="max-width:900px">

  {{-- ── HERO SECTION ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden;margin-bottom:1.5rem">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#6C63FF0d">
      <div style="width:10px;height:10px;border-radius:50%;background:#6C63FF"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">Hero Section</span>
    </div>
    <div style="padding:1.5rem">
      <form method="POST" action="{{ route('admin.service-builder.section.update', 'hero') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Main Heading (HTML Supported)</label>
            <input type="text" name="heading" value="{{ $sections['hero']->heading ?? 'Our <em>Services</em>' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Subheading</label>
            <input type="text" name="subheading" value="{{ $sections['hero']->subheading ?? 'What We Offer' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          
          <div style="grid-column: 1 / -1;">
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Body Text</label>
            <textarea name="body" rows="3" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">{{ $sections['hero']->body ?? "From talent representation to global campaigns — we deliver at every stage of the creative journey." }}</textarea>
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
            @if(!empty($sections['hero']->video_url))
            <div style="margin-top:.5rem">
                <span style="font-size:.7rem;color:#8B90A0;display:block;margin-bottom:.2rem">Current video active</span>
                <video src="{{ $sections['hero']->video_url }}" muted style="height:50px;border-radius:4px"></video>
            </div>
            @endif
          </div>
        </div>
        <button type="submit" style="background:#6C63FF;color:#fff;padding:.55rem 1.25rem;border:none;border-radius:8px;cursor:pointer;font-size:.8rem;font-weight:600">Save Hero Section</button>
      </form>
    </div>
  </div>

  {{-- ── PROCESS HEADING ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden;margin-bottom:1.5rem">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#8B5CF60d">
      <div style="width:10px;height:10px;border-radius:50%;background:#8B5CF6"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">Process Heading (How It Works)</span>
    </div>
    <div style="padding:1.5rem">
      <form method="POST" action="{{ route('admin.service-builder.section.update', 'process_heading') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Main Heading (HTML)</label>
            <input type="text" name="heading" value="{{ $sections['process_heading']->heading ?? 'Our Process<br><em style=\"opacity:.6\">Is Simple.</em>' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Subheading</label>
            <input type="text" name="subheading" value="{{ $sections['process_heading']->subheading ?? 'How It Works' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div style="grid-column: 1 / -1;">
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Description</label>
            <textarea name="body" rows="2" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">{{ $sections['process_heading']->body ?? 'From the first conversation to global recognition — our structured approach ensures every talent reaches their full potential.' }}</textarea>
          </div>
        </div>
        <button type="submit" style="background:#8B5CF6;color:#fff;padding:.55rem 1.25rem;border:none;border-radius:8px;cursor:pointer;font-size:.8rem;font-weight:600">Save Process Heading</button>
      </form>
    </div>
  </div>

  {{-- ── PROCESS STEPS ── --}}
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem">
      @foreach(['process_1' => 'Step 01', 'process_2' => 'Step 02', 'process_3' => 'Step 03', 'process_4' => 'Step 04'] as $key => $label)
      <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden">
        <div style="padding:.75rem 1.25rem;border-bottom:1px solid #E4E6F0;background:#F4F5FA">
          <span style="font-size:.75rem;font-weight:600;color:#0B132B">{{ $label }}</span>
        </div>
        <div style="padding:1.25rem">
          <form method="POST" action="{{ route('admin.service-builder.section.update', $key) }}" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Number (e.g. 01)</label>
                <input type="text" name="subheading" value="{{ $sections[$key]->subheading ?? '' }}" style="width:100%;padding:.5rem;border:1.5px solid #E4E6F0;border-radius:6px;font-size:.8rem;color:#0B132B">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Title</label>
                <input type="text" name="heading" value="{{ $sections[$key]->heading ?? '' }}" style="width:100%;padding:.5rem;border:1.5px solid #E4E6F0;border-radius:6px;font-size:.8rem;color:#0B132B">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Description</label>
                <textarea name="body" rows="2" style="width:100%;padding:.5rem;border:1.5px solid #E4E6F0;border-radius:6px;font-size:.8rem;color:#0B132B">{{ $sections[$key]->body ?? '' }}</textarea>
            </div>
            <button type="submit" style="background:#0B132B;color:#fff;padding:.4rem 1rem;border:none;border-radius:6px;cursor:pointer;font-size:.7rem;font-weight:600">Save Step</button>
          </form>
        </div>
      </div>
      @endforeach
  </div>

</div>
@endsection
