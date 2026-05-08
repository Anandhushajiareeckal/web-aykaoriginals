@extends('admin.layouts.app')
@section('title','Homepage Builder')
@section('content')

<div style="max-width:900px">

  {{-- ── HERO SECTION ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden;margin-bottom:1.5rem">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#6C63FF0d">
      <div style="width:10px;height:10px;border-radius:50%;background:#6C63FF"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">Hero / Video Banner</span>
      <span style="font-size:.7rem;color:#8B90A0;margin-left:.5rem">Front page full-screen video section</span>
    </div>
    <div style="padding:1.5rem">
      <form method="POST" action="{{ route('admin.homepage.section.update','hero') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem" class="sm:grid-cols-2">
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Main Heading</label>
            <input type="text" name="heading" value="{{ $sections['hero']->heading ?? 'WHERE TALENT MEETS VISION' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B" placeholder="Main heading text">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Sub-Heading / Tag</label>
            <input type="text" name="subheading" value="{{ $sections['hero']->subheading ?? '' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B" placeholder="Small tag above heading">
          </div>
          <div style="grid-column:span 2">
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Description</label>
            <textarea name="body" rows="3" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B;resize:vertical" placeholder="Hero description text">{{ $sections['hero']->body ?? '' }}</textarea>
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Upload Local Video (MP4)</label>
            <input type="file" name="video_file" accept="video/mp4,video/x-m4v,video/*" style="width:100%;padding:.5rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
            <p style="font-size:.7rem;color:#8B90A0;margin-top:.35rem">Upload from computer (takes precedence over URL).</p>
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Or Video URL</label>
            <input type="text" name="video_url" value="{{ $sections['hero']->video_url ?? '' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B" placeholder="https://example.com/video.mp4">
            @if(!empty($sections['hero']->video_url))
              <div style="margin-top:.35rem;font-size:.75rem;">
                Current: <a href="{{ $sections['hero']->video_url }}" target="_blank" style="color:#6C63FF;text-decoration:underline;">View Video</a>
              </div>
            @endif
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Button 1 Label</label>
            <input type="text" name="btn1_label" value="{{ $sections['hero']->btn1_label ?? 'Discover Talent' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Button 1 URL</label>
            <input type="text" name="btn1_url" value="{{ $sections['hero']->btn1_url ?? '/talent' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Button 2 Label</label>
            <input type="text" name="btn2_label" value="{{ $sections['hero']->btn2_label ?? 'Our Work' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Button 2 URL</label>
            <input type="text" name="btn2_url" value="{{ $sections['hero']->btn2_url ?? '/work' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
        </div>
        <button type="submit" style="display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;background:linear-gradient(135deg,#6C63FF,#8B80FF);color:#fff;font-size:.72rem;font-weight:600;border:none;border-radius:8px;cursor:pointer">
          <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          Save Hero Section
        </button>
      </form>
    </div>
  </div>

  {{-- ── CLIENT LOGOS ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden;margin-bottom:1.5rem">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#06B6D40d">
      <div style="width:10px;height:10px;border-radius:50%;background:#06B6D4"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">Client Logos Section</span>
    </div>
    <div style="padding:1.5rem">

      {{-- Section heading --}}
      <form method="POST" action="{{ route('admin.homepage.section.update','clients') }}" style="margin-bottom:1.5rem">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Section Heading</label>
            <input type="text" name="heading" value="{{ $sections['clients']->heading ?? 'Trusted By Leading Brands' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Sub Label</label>
            <input type="text" name="subheading" value="{{ $sections['clients']->subheading ?? 'Our Clients' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
        </div>
        <button type="submit" style="display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;background:linear-gradient(135deg,#06B6D4,#0891b2);color:#fff;font-size:.72rem;font-weight:600;border:none;border-radius:8px;cursor:pointer">Save Heading</button>
      </form>

      {{-- Existing logos --}}
      @if($clients->count())
      <div style="display:flex;flex-wrap:wrap;gap:.75rem;margin-bottom:1.5rem">
        @foreach($clients as $client)
        <div style="display:flex;align-items:center;gap:.5rem;padding:.5rem .875rem;border:1px solid #E4E6F0;border-radius:8px;background:#F4F5FA">
          @if($client->hasMedia('logo'))
            <img src="{{ $client->getFirstMediaUrl('logo','thumb') }}" style="height:24px;object-fit:contain">
          @else
            <span style="font-size:.75rem;font-weight:600;color:#0B132B;letter-spacing:.1em">{{ strtoupper($client->name) }}</span>
          @endif
          <form method="POST" action="{{ route('admin.homepage.clients.destroy',$client) }}" onsubmit="return confirm('Remove?')" style="display:inline">
            @csrf @method('DELETE')
            <button type="submit" style="background:none;border:none;cursor:pointer;color:#EF4444;font-size:.75rem;line-height:1;padding:0">✕</button>
          </form>
        </div>
        @endforeach
      </div>
      @endif

      {{-- Add new logo --}}
      <form method="POST" action="{{ route('admin.homepage.clients.store') }}" enctype="multipart/form-data">
        @csrf
        <div style="display:grid;grid-template-columns:1fr 1fr auto;gap:.75rem;align-items:end">
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Client Name *</label>
            <input type="text" name="name" required style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B" placeholder="Brand name">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Logo Image (optional)</label>
            <input type="file" name="logo" accept="image/*" style="width:100%;padding:.5rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.82rem">
          </div>
          <button type="submit" style="display:inline-flex;align-items:center;gap:.4rem;padding:.65rem 1.25rem;background:#0B132B;color:#fff;font-size:.72rem;font-weight:600;border:none;border-radius:8px;cursor:pointer;white-space:nowrap">+ Add Client</button>
        </div>
      </form>
    </div>
  </div>

  {{-- ── ABOUT SECTION ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden;margin-bottom:1.5rem">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#22C55E0d">
      <div style="width:10px;height:10px;border-radius:50%;background:#22C55E"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">About Section</span>
    </div>
    <div style="padding:1.5rem">
      <form method="POST" action="{{ route('admin.homepage.section.update','about') }}">
        @csrf
        <div style="display:flex;flex-direction:column;gap:1rem;margin-bottom:1rem">
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Heading</label>
            <input type="text" name="heading" value="{{ $sections['about']->heading ?? '' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Sub Label</label>
            <input type="text" name="subheading" value="{{ $sections['about']->subheading ?? 'About Us' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Body Text</label>
            <textarea name="body" rows="4" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B;resize:vertical">{{ $sections['about']->body ?? '' }}</textarea>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div>
              <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Button Label</label>
              <input type="text" name="btn1_label" value="{{ $sections['about']->btn1_label ?? 'Learn More' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
            </div>
            <div>
              <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Button URL</label>
              <input type="text" name="btn1_url" value="{{ $sections['about']->btn1_url ?? '/about' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
            </div>
          </div>
        </div>
        <button type="submit" style="display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;background:linear-gradient(135deg,#22C55E,#16a34a);color:#fff;font-size:.72rem;font-weight:600;border:none;border-radius:8px;cursor:pointer">
          <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          Save About Section
        </button>
      </form>
    </div>
  </div>

  {{-- ── CTA SECTION ── --}}
  <div style="background:#fff;border-radius:12px;border:1px solid #E4E6F0;overflow:hidden">
    <div style="padding:1rem 1.25rem;border-bottom:1px solid #E4E6F0;display:flex;align-items:center;gap:.75rem;background:#F59E0B0d">
      <div style="width:10px;height:10px;border-radius:50%;background:#F59E0B"></div>
      <span style="font-size:.85rem;font-weight:600;color:#0B132B">CTA / Call-to-Action Banner</span>
    </div>
    <div style="padding:1.5rem">
      <form method="POST" action="{{ route('admin.homepage.section.update','cta') }}">
        @csrf
        <div style="display:flex;flex-direction:column;gap:1rem;margin-bottom:1rem">
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div>
              <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Heading</label>
              <input type="text" name="heading" value="{{ $sections['cta']->heading ?? 'Ready to Create Something Exceptional?' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
            </div>
            <div>
              <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Sub Label</label>
              <input type="text" name="subheading" value="{{ $sections['cta']->subheading ?? 'Work With Us' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
            </div>
          </div>
          <div>
            <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Body Text</label>
            <textarea name="body" rows="2" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B;resize:vertical">{{ $sections['cta']->body ?? '' }}</textarea>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
            <div>
              <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Button Label</label>
              <input type="text" name="btn1_label" value="{{ $sections['cta']->btn1_label ?? 'Contact Us' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
            </div>
            <div>
              <label style="display:block;font-size:.65rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">Button URL</label>
              <input type="text" name="btn1_url" value="{{ $sections['cta']->btn1_url ?? '/contact' }}" style="width:100%;padding:.625rem .875rem;border:1.5px solid #E4E6F0;border-radius:8px;font-size:.85rem;color:#0B132B">
            </div>
          </div>
        </div>
        <button type="submit" style="display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;background:linear-gradient(135deg,#F59E0B,#d97706);color:#fff;font-size:.72rem;font-weight:600;border:none;border-radius:8px;cursor:pointer">
          <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          Save CTA Section
        </button>
      </form>
    </div>
  </div>

</div>
@endsection
