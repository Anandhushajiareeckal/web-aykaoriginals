@extends('layouts.app')
@section('title', 'Production — AYKA Originals')
@section('description', 'AYKA Originals production projects — campaigns, editorials, and lookbooks for luxury fashion brands.')

@push('styles')
<style>
  :root { --p-dark: #090e17; --p-card: rgba(255,255,255,0.03); --p-border: rgba(255,255,255,0.08); --accent: #6C63FF; }
  body { background: var(--p-dark) !important; color: #fff !important; }

  /* HERO */
  .prod-hero { min-height: 60vh; background: var(--p-dark); display: flex; align-items: flex-end; padding: 0 1.5rem 5rem; position: relative; overflow: hidden; padding-top: 7rem; }
  .prod-hero-bg { position: absolute; inset: 0; background: radial-gradient(ellipse at 70% 40%, rgba(108,99,255,.15) 0%, transparent 60%), radial-gradient(ellipse at 20% 80%, rgba(6,182,212,.06) 0%, transparent 55%); pointer-events: none; }
  .prod-hero-grid-lines { position: absolute; inset: 0; background-image: linear-gradient(rgba(255,255,255,.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.02) 1px, transparent 1px); background-size: 80px 80px; pointer-events: none; }
  .prod-hero-inner { max-width: 1440px; margin: 0 auto; width: 100%; display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: flex-end; position: relative; z-index: 2; }
  .prod-hero-tag { display: inline-flex; align-items: center; gap: .6rem; background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1); padding: .4rem 1.2rem; border-radius: 999px; margin-bottom: 2rem; backdrop-filter: blur(8px); }
  .prod-hero-tag span { width: 6px; height: 6px; border-radius: 50%; background: var(--accent); animation: pulse-p 2s infinite; }
  .prod-hero-title { font-family: 'Cormorant Garamond', serif; font-size: clamp(3.5rem, 7vw, 7rem); font-weight: 300; line-height: 0.95; color: #fff; margin-bottom: 1.5rem; }
  .prod-hero-sub { font-size: .9rem; color: rgba(255,255,255,.5); line-height: 1.8; font-weight: 300; max-width: 420px; }
  .prod-hero-stats { display: flex; gap: 3rem; }
  .prod-stat-val { font-family: 'Cormorant Garamond', serif; font-size: 3rem; font-weight: 300; color: #fff; line-height: 1; }
  .prod-stat-lbl { font-size: .6rem; letter-spacing: .2em; text-transform: uppercase; color: rgba(255,255,255,.4); margin-top: .4rem; }

  /* GRID */
  .prod-section { background: #0e1320; padding: 6rem 1.5rem 8rem; }
  .prod-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; max-width: 1440px; margin: 0 auto; }
  @media (max-width: 1024px) { .prod-grid { grid-template-columns: repeat(2, 1fr); } }
  @media (max-width: 640px) { .prod-grid { grid-template-columns: 1fr; } .prod-hero-inner { grid-template-columns: 1fr; } .prod-hero-stats { flex-wrap: wrap; gap: 1.5rem; } }

  /* CARD */
  .prod-card { background: var(--p-card); border: 1px solid var(--p-border); border-radius: 16px; overflow: hidden; text-decoration: none; color: #fff; display: flex; flex-direction: column; transition: border-color .3s, transform .3s, box-shadow .3s; }
  .prod-card:hover { border-color: rgba(108,99,255,.4); transform: translateY(-6px); box-shadow: 0 30px 80px rgba(0,0,0,.3); }
  .prod-card-img { width: 100%; aspect-ratio: 16/9; object-fit: cover; display: block; transition: transform .5s ease; }
  .prod-card:hover .prod-card-img { transform: scale(1.04); }
  .prod-card-img-wrap { overflow: hidden; position: relative; }
  .prod-card-img-placeholder { width: 100%; aspect-ratio: 16/9; background: linear-gradient(135deg, #1a2444, #0B132B); display: flex; align-items: center; justify-content: center; }
  .prod-card-body { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }
  .prod-card-tag { font-size: .55rem; letter-spacing: .25em; text-transform: uppercase; color: var(--accent); font-weight: 700; margin-bottom: .75rem; display: flex; align-items: center; gap: .5rem; }
  .prod-card-tag::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: var(--accent); display: inline-block; }
  .prod-card-title { font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; font-weight: 300; color: #fff; line-height: 1.2; margin-bottom: .75rem; }
  .prod-card-desc { font-size: .75rem; color: rgba(255,255,255,.45); line-height: 1.7; flex: 1; margin-bottom: 1.25rem; }
  .prod-card-footer { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--p-border); padding-top: 1rem; }
  .prod-card-year { font-size: .6rem; color: rgba(255,255,255,.3); letter-spacing: .1em; }
  .prod-card-arrow { display: flex; align-items: center; gap: .4rem; font-size: .6rem; letter-spacing: .2em; text-transform: uppercase; color: rgba(255,255,255,.4); transition: color .3s; }
  .prod-card:hover .prod-card-arrow { color: var(--accent); }
  .prod-card-arrow svg { width: 14px; height: 14px; transition: transform .3s; }
  .prod-card:hover .prod-card-arrow svg { transform: translateX(4px); }

  /* SECTION HEADER */
  .prod-section-head { max-width: 1440px; margin: 0 auto 3rem; display: flex; align-items: flex-end; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }

  @keyframes pulse-p { 0%,100%{ opacity:1; transform:scale(1) } 50%{ opacity:.5; transform:scale(1.5) } }
  @keyframes fadeUp { from { opacity:0; transform:translateY(20px) } to { opacity:1; transform:translateY(0) } }
  .prod-hero-inner > * { animation: fadeUp .9s ease both; }
  .prod-hero-inner > *:nth-child(2) { animation-delay: .15s; }
</style>
@endpush

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="prod-hero">
  <div class="prod-hero-bg"></div>
  <div class="prod-hero-grid-lines"></div>
  <div class="prod-hero-inner">
    <div>
      <div class="prod-hero-tag">
        <span></span>
        <span style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.8)">Our Work</span>
      </div>
      <h1 class="prod-hero-title">{!! optional($sections->get('hero'))->heading ?? 'Production<br><em style="opacity:.65">in Motion.</em>' !!}</h1>
      <p class="prod-hero-sub">{!! optional($sections->get('hero'))->body ?? 'From concept to campaign — we bring luxury brands to life through cinematic production, editorial photography, and immersive creative direction.' !!}</p>
    </div>
    <div>
      <div class="prod-hero-stats">
        <div>
          <div class="prod-stat-val">{{ $projects->total() }}+</div>
          <div class="prod-stat-lbl">Total Projects</div>
        </div>
        <div>
          <div class="prod-stat-val">3+</div>
          <div class="prod-stat-lbl">Countries</div>
        </div>
        <div>
          <div class="prod-stat-val">50+</div>
          <div class="prod-stat-lbl">Brand Clients</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ═══ PROJECT GRID ═══ --}}
<section class="prod-section">
  <div class="prod-section-head">
    <div>
      <p style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:.5rem">Our Portfolio</p>
      <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2rem,4vw,3.5rem);color:#fff;font-weight:300;line-height:1.05">Projects &amp; <em style="opacity:.65">Case Studies</em></h2>
    </div>
  </div>

  <div class="prod-grid">
    @forelse($projects as $project)
    <a href="{{ route('projects.show', $project->slug) }}" class="prod-card">
      <div class="prod-card-img-wrap">
        @if($project->hasMedia('gallery'))
          <img src="{{ $project->getFirstMediaUrl('gallery','medium') }}" alt="{{ $project->brand }}" class="prod-card-img" loading="lazy">
        @else
          <div class="prod-card-img-placeholder">
            <span style="font-family:'Cormorant Garamond',serif;font-size:3rem;color:rgba(255,255,255,.15)">{{ substr($project->brand ?? 'P', 0, 1) }}</span>
          </div>
        @endif
      </div>
      <div class="prod-card-body">
        <div class="prod-card-tag">{{ $project->service_type ?? 'Production' }}</div>
        <h3 class="prod-card-title">{{ $project->brand }}</h3>
        @if($project->description)
          <p class="prod-card-desc">{{ Str::limit($project->description, 120) }}</p>
        @endif
        <div class="prod-card-footer">
          <span class="prod-card-year">{{ $project->year }}</span>
          <span class="prod-card-arrow">
            View Project
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          </span>
        </div>
      </div>
    </a>
    @empty
    <div style="grid-column:1/-1;text-align:center;padding:6rem 2rem;border:1px dashed rgba(255,255,255,.1);border-radius:16px">
      <p style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;color:rgba(255,255,255,.3)">Projects coming soon</p>
    </div>
    @endforelse
  </div>

  @if($projects->hasPages())
  <div style="margin-top:3rem;display:flex;justify-content:center">{{ $projects->links() }}</div>
  @endif
</section>

{{-- ═══ CTA ═══ --}}
<section style="background:#090e17;padding:8rem 1.5rem;text-align:center;position:relative;overflow:hidden">
  <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 50% 50%,rgba(108,99,255,.1) 0%,transparent 70%);pointer-events:none"></div>
  <div style="position:relative;z-index:2;max-width:700px;margin:0 auto">
    <p style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:1.25rem">{!! optional($sections->get('cta'))->subheading ?? 'Work With Us' !!}</p>
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,5vw,4.5rem);color:#fff;font-weight:300;line-height:1.05;margin-bottom:1.5rem">{!! optional($sections->get('cta'))->heading ?? 'Have a project<br><em style="opacity:.7">in mind?</em>' !!}</h2>
    <p style="font-size:.9rem;color:rgba(255,255,255,.5);line-height:1.9;margin-bottom:3rem;font-weight:300">{!! optional($sections->get('cta'))->body ?? "We'd love to collaborate. Let's create something extraordinary together." !!}</p>
    <a href="{{ route('inquiries.create') }}" style="display:inline-flex;align-items:center;gap:.75rem;padding:1.1rem 3rem;background:#fff;color:#090e17;font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;font-weight:600;text-decoration:none;transition:all .3s;border-radius:4px" onmouseover="this.style.background='#6C63FF';this.style.color='#fff'" onmouseout="this.style.background='#fff';this.style.color='#090e17'">
      Start a Project
      <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    </a>
  </div>
</section>

@endsection
