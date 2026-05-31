@extends('layouts.app')
@section('title', $project->brand . ' — ' . $project->service_type)

@push('styles')
<style>
  :root { --p-dark: #090e17; --p-card: rgba(255,255,255,0.03); --p-border: rgba(255,255,255,0.08); --accent: #6C63FF; }
  body { background: var(--p-dark) !important; color: #fff !important; }
  
  .proj-hero { height: 75vh; position: relative; overflow: hidden; display: flex; align-items: flex-end; padding-bottom: 4rem; }
  .proj-hero-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; animation: zoomIn 15s linear infinite alternate; }
  .proj-hero-overlay { position: absolute; inset: 0; background: linear-gradient(to top, var(--p-dark) 0%, rgba(9,14,23,0.5) 40%, rgba(9,14,23,0.2) 100%); }
  
  .proj-hero-content { position: relative; z-index: 2; width: 100%; max-width: 1440px; margin: 0 auto; padding: 0 1.5rem; animation: fadeUp .8s ease both; }
  .proj-tag { display: inline-flex; font-size: .65rem; letter-spacing: .25em; text-transform: uppercase; color: var(--accent); margin-bottom: 1rem; align-items: center; gap: .5rem; }
  .proj-tag::before { content: ''; width: 4px; height: 4px; background: var(--accent); border-radius: 50%; }
  .proj-title { font-family: 'Cormorant Garamond', serif; font-size: clamp(3rem, 7vw, 6rem); color: #fff; font-weight: 300; line-height: 1; text-shadow: 0 4px 20px rgba(0,0,0,0.5); }
  
  .proj-body { max-width: 1440px; margin: 0 auto; padding: 4rem 1.5rem; }
  .proj-info-grid { display: grid; grid-template-columns: 1fr 3fr; gap: 4rem; margin-bottom: 6rem; padding-bottom: 4rem; border-bottom: 1px solid var(--p-border); }
  @media (max-width: 1024px) { .proj-info-grid { grid-template-columns: 1fr; gap: 3rem; } }
  
  .proj-meta-table { width: 100%; }
  .proj-meta-table td { padding: 1rem 0; border-bottom: 1px dashed var(--p-border); }
  .proj-meta-lbl { font-size: .6rem; letter-spacing: .2em; text-transform: uppercase; color: rgba(255,255,255,.4); }
  .proj-meta-val { font-size: .9rem; color: #fff; text-align: right; font-weight: 300; }
  
  .proj-desc { font-size: 1.1rem; color: rgba(255,255,255,.6); line-height: 2; font-weight: 300; }
  
  .proj-gallery { columns: 1; column-gap: 1.5rem; }
  @media (min-width: 640px) { .proj-gallery { columns: 2; } }
  @media (min-width: 1024px) { .proj-gallery { columns: 3; } }
  .proj-gallery-item { margin-bottom: 1.5rem; break-inside: avoid; border-radius: 12px; overflow: hidden; position: relative; }
  .proj-gallery-item img { width: 100%; display: block; transition: transform .5s; }
  .proj-gallery-item:hover img { transform: scale(1.03); }
  
  .back-btn { display: inline-flex; align-items: center; gap: .75rem; font-size: .7rem; letter-spacing: .2em; text-transform: uppercase; color: rgba(255,255,255,.5); transition: color .3s; margin-top: 4rem; padding: 1rem 2rem; border: 1px solid var(--p-border); border-radius: 999px; text-decoration: none; }
  .back-btn:hover { color: #fff; border-color: rgba(255,255,255,.3); }

  @keyframes zoomIn { from { transform: scale(1) } to { transform: scale(1.1) } }
  @keyframes fadeUp { from { opacity: 0; transform: translateY(20px) } to { opacity: 1; transform: translateY(0) } }
</style>
@endpush

@section('content')

@if($project->hasMedia('gallery'))
<section class="proj-hero">
  <img src="{{ $project->getFirstMediaUrl('gallery','large') }}" alt="{{ $project->brand }}" class="proj-hero-img">
  <div class="proj-hero-overlay"></div>
  <div class="proj-hero-content">
    <div class="proj-tag">{{ $project->service_type }} &middot; {{ $project->year }}</div>
    <h1 class="proj-title">{{ $project->brand }}</h1>
  </div>
</section>
@else
<section class="proj-hero" style="background:#0e1320;height:40vh">
  <div class="proj-hero-content">
    <div class="proj-tag">{{ $project->service_type }}</div>
    <h1 class="proj-title">{{ $project->brand }}</h1>
  </div>
</section>
@endif

<section class="proj-body">
  <div class="proj-info-grid">
    <div>
      <table class="proj-meta-table">
        <tr><td class="proj-meta-lbl">Client</td><td class="proj-meta-val">{{ $project->brand }}</td></tr>
        <tr><td class="proj-meta-lbl">Service</td><td class="proj-meta-val">{{ $project->service_type }}</td></tr>
        <tr><td class="proj-meta-lbl">Year</td><td class="proj-meta-val">{{ $project->year }}</td></tr>
      </table>
    </div>
    <div>
      @if($project->description)
        <p class="proj-desc">{{ $project->description }}</p>
      @endif
    </div>
  </div>

  @if($project->getMedia('gallery')->count() > 1)
  <div class="proj-gallery">
    @foreach($project->getMedia('gallery') as $i => $img)
      @if($i > 0)
      <div class="proj-gallery-item">
        <img src="{{ $img->getUrl('large') }}" alt="{{ $project->brand }} Gallery" loading="lazy">
      </div>
      @endif
    @endforeach
  </div>
  @endif

  <div style="text-align:center">
    <a href="{{ route('projects.index') }}" class="back-btn">
      <svg style="width:14px;height:14px;transform:rotate(180deg)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      Back to Projects
    </a>
  </div>
</section>

@endsection
