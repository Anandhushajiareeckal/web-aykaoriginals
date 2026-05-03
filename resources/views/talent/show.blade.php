@extends('layouts.app')
@section('title', $talent->name . ' — Portfolio')
@section('description', $talent->bio ? Str::limit($talent->bio,160) : $talent->name.' — represented by AYKA Originals.')

@section('meta')
<script type="application/ld+json">{"@context":"https://schema.org","@type":"Person","name":"{{ $talent->name }}","url":"{{ route('talent.show',$talent->slug) }}","jobTitle":"{{ $talent->category }}","worksFor":{"@type":"Organization","name":"AYKA Originals"}@if($talent->hasMedia('profile')),"image":"{{ $talent->getFirstMediaUrl('profile','large') }}"@endif}</script>
@endsection

@section('content')
<style>
    :root {
        --portfolio-bg: #060a1a;
        --portfolio-text: #ffffff;
        --portfolio-accent: #c4a47c; /* Bronze/Gold */
        --portfolio-muted: rgba(255,255,255,0.5);
    }

    body { background: var(--portfolio-bg) !important; color: var(--portfolio-text) !important; }

    .hero-section {
        height: 100vh;
        width: 100%;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }

    .hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
        filter: brightness(0.6);
        transform: scale(1.05);
        transition: transform 10s ease;
    }

    .hero-section:hover .hero-bg img { transform: scale(1); }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(6,10,26,0.2) 0%, rgba(6,10,26,0.8) 100%);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        max-width: 900px;
        padding: 0 2rem;
    }

    .hero-category {
        font-size: 0.75rem;
        letter-spacing: 0.4em;
        text-transform: uppercase;
        color: var(--portfolio-accent);
        margin-bottom: 1.5rem;
        display: block;
        animation: fadeInUp 1s ease both;
    }

    .hero-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(3.5rem, 10vw, 7rem);
        line-height: 0.9;
        font-weight: 300;
        margin-bottom: 2rem;
        animation: fadeInUp 1.2s ease 0.2s both;
    }

    .hero-scroll {
        position: absolute;
        bottom: 3rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        opacity: 0.6;
        animation: fadeIn 2s ease 1s both;
    }

    .scroll-line {
        width: 1px;
        height: 60px;
        background: linear-gradient(to bottom, var(--portfolio-accent), transparent);
    }

    /* About & Stats Section */
    .section-about { padding: 10rem 2rem; max-width: 1280px; margin: 0 auto; }

    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 6rem;
        align-items: start;
    }

    @media (max-width: 1024px) {
        .about-grid { grid-template-columns: 1fr; gap: 4rem; }
    }

    .measurements-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 3rem 2rem;
    }

    .stat-item { border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 1rem; }
    .stat-label { font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--portfolio-muted); margin-bottom: 0.5rem; }
    .stat-val { font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; color: #fff; }

    .about-text h2 { font-family: 'Cormorant Garamond', serif; font-size: 2.5rem; margin-bottom: 2rem; font-weight: 400; color: #fff; }
    .about-text p { font-size: 1rem; line-height: 1.8; color: var(--portfolio-muted); }

    /* Portfolio Gallery */
    .gallery-section { padding: 0 2rem 10rem; max-width: 1800px; margin: 0 auto; }
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 1.5rem;
    }

    @media (max-width: 640px) {
        .gallery-grid { grid-template-columns: 1fr; }
    }

    .gallery-item {
        position: relative;
        aspect-ratio: 3/4;
        overflow: hidden;
        background: #0d1226;
        cursor: pointer;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
        transition: transform 0.8s cubic-bezier(0.2, 1, 0.3, 1);
    }

    .gallery-item:hover img { transform: scale(1.08); }

    /* Inquiry Section */
    .booking-section { padding: 10rem 2rem; background: #0b132b; }
    .booking-inner { max-width: 800px; margin: 0 auto; text-align: center; }

    .booking-inner h2 { font-family: 'Cormorant Garamond', serif; font-size: 3.5rem; margin-bottom: 1.5rem; font-weight: 300; }
    .booking-inner p { color: var(--portfolio-muted); margin-bottom: 4rem; font-size: 1.1rem; }

    .form-dark .form-field {
        background: transparent;
        border-color: rgba(255,255,255,0.1);
        color: #fff;
        padding: 1rem 0;
        font-size: 1rem;
    }

    .form-dark .form-field:focus { border-color: var(--portfolio-accent); }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

    /* Custom scrollbar for dark theme */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #060a1a; }
    ::-webkit-scrollbar-thumb { background: #1a233a; border-radius: 4px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--portfolio-accent); }

    .nav-scrolled { background: rgba(6, 10, 26, 0.95) !important; }
</style>

{{-- ── HERO SECTION ── --}}
<section class="hero-section">
    <div class="hero-bg">
        @if($talent->hasMedia('cover'))
            <img src="{{ $talent->getFirstMediaUrl('cover','large') }}" alt="{{ $talent->name }}">
        @elseif($talent->hasMedia('profile'))
            <img src="{{ $talent->getFirstMediaUrl('profile','large') }}" alt="{{ $talent->name }}">
        @endif
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <span class="hero-category">{{ $talent->category }}</span>
        <h1 class="hero-name">{{ $talent->name }}</h1>
        @if($talent->location)
            <p style="font-size:0.8rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--portfolio-muted)">Represented in {{ $talent->location }}</p>
        @endif
    </div>
    <div class="hero-scroll">
        <span style="font-size:0.6rem; letter-spacing:0.3em; text-transform:uppercase">Discover</span>
        <div class="scroll-line"></div>
    </div>
</section>

{{-- ── ABOUT & MEASUREMENTS ── --}}
<section class="section-about">
    <div class="about-grid">
        <div class="measurements">
            <div class="measurements-grid">
                @foreach([
                    ['Height','height'],
                    ['Chest / Bust','chest_bust'],
                    ['Waist','waist'],
                    ['Hips','hips'],
                    ['Weight','weight'],
                    ['Inseam','inseam'],
                    ['Shoes','shoe_size'],
                    ['Eyes','eye_color'],
                    ['Hair','hair_color']
                ] as [$l,$k])
                    @if($talent->$k)
                    <div class="stat-item">
                        <p class="stat-label">{{ $l }}</p>
                        <p class="stat-val">{{ $talent->$k }}</p>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="about-text">
            <h2>The Profile</h2>
            @if($talent->bio)
                <p>{{ $talent->bio }}</p>
            @else
                <p>{{ $talent->name }} is an emerging talent in the {{ $talent->category }} category, represented by AYKA Originals. Known for their unique look and professional versatility, they bring a distinct presence to every campaign and editorial project.</p>
            @endif

            <div style="margin-top:4rem">
                <a href="#book" class="btn-navy" style="background:var(--portfolio-accent); border:none; color:#000; padding: 1.25rem 3rem">Book {{ explode(' ',$talent->name)[0] }}</a>
            </div>
        </div>
    </div>
</section>

{{-- ── PORTFOLIO GALLERY ── --}}
@php $gallery = $talent->getMedia('portfolio'); @endphp
@if($gallery->count())
<section class="gallery-section">
    <div style="margin-bottom:4rem; text-align:center">
        <p style="font-size:0.7rem; letter-spacing:0.4em; text-transform:uppercase; color:var(--portfolio-muted); margin-bottom:1rem">Portfolio</p>
        <h2 style="font-family:'Cormorant Garamond',serif; font-size:3rem; font-weight:300">Selected Works</h2>
    </div>
    <div class="gallery-grid">
        @foreach($gallery as $i => $media)
        <div class="gallery-item" @click="/* lightbox logic could go here */">
            <img src="{{ $media->getUrl('large') }}" 
                 srcset="{{ $media->getUrl('medium') }} 800w, {{ $media->getUrl('large') }} 1600w" 
                 sizes="(max-width:640px) 100vw, (max-width:1280px) 50vw, 33vw"
                 alt="{{ $talent->name }} Portfolio {{ $i+1 }}"
                 loading="lazy">
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ── BOOKING INQUIRY ── --}}
<section id="book" class="booking-section">
    <div class="booking-inner">
        <p style="font-size:0.7rem; letter-spacing:0.4em; text-transform:uppercase; color:var(--portfolio-accent); margin-bottom:1rem">Inquiry</p>
        <h2>Start a Conversation</h2>
        <p>Inquire about {{ $talent->name }} for your upcoming campaign, editorial, or production.</p>

        <form method="POST" action="{{ route('inquiries.store') }}" class="form-dark" style="text-align:left; display:grid; grid-template-columns:1fr 1fr; gap:2rem">
            @csrf
            <input type="hidden" name="talent_id" value="{{ $talent->id }}">
            <input type="hidden" name="type" value="talent_booking">

            <div class="form-group">
                <label class="stat-label">Full Name</label>
                <input type="text" name="name" required class="form-field" placeholder="Your name">
            </div>
            <div class="form-group">
                <label class="stat-label">Email Address</label>
                <input type="email" name="email" required class="form-field" placeholder="email@address.com">
            </div>
            <div class="form-group" style="grid-column: span 2">
                <label class="stat-label">Message / Project Details</label>
                <textarea name="message" required rows="4" class="form-field" placeholder="Describe the project, timeline, and requirements..."></textarea>
            </div>
            <div style="grid-column: span 2; padding-top:2rem">
                <button type="submit" class="btn-navy" style="width:100%; justify-content:center; padding:1.25rem; font-size:0.8rem; letter-spacing:0.3em; background: transparent; border: 1px solid var(--portfolio-accent); color: var(--portfolio-accent)">Send Inquiry</button>
            </div>
        </form>
    </div>
</section>

{{-- ── RELATED TALENT ── --}}
@if($relatedTalents->count())
<section style="padding:10rem 2rem; border-top:1px solid rgba(255,255,255,0.05)">
    <div style="max-width:1280px; margin:0 auto">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:4rem">
            <h2 style="font-family:'Cormorant Garamond',serif; font-size:2.5rem; font-weight:300">More Faces</h2>
            <a href="{{ route('talent.index') }}" style="font-size:0.65rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--portfolio-muted); border-bottom:1px solid var(--portfolio-muted)">View All</a>
        </div>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:2rem" class="mobile-grid">
            @foreach($relatedTalents as $r)
            <a href="{{ route('talent.show',$r->slug) }}" style="text-decoration:none; color:inherit; group">
                <div style="aspect-ratio:3/4; overflow:hidden; background:#0d1226; margin-bottom:1rem">
                    @if($r->hasMedia('profile'))
                        <img src="{{ $r->getFirstMediaUrl('profile','medium') }}" alt="{{ $r->name }}" style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s">
                    @endif
                </div>
                <h3 style="font-family:'Cormorant Garamond',serif; font-size:1.1rem; font-weight:400">{{ $r->name }}</h3>
                <p style="font-size:0.6rem; letter-spacing:0.1em; text-transform:uppercase; color:var(--portfolio-muted)">{{ $r->category }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
    @media (max-width: 768px) {
        .mobile-grid { grid-template-columns: repeat(2, 1fr) !important; }
        .form-dark { grid-template-columns: 1fr !important; }
        .booking-inner h2 { font-size: 2.5rem; }
    }
</style>

@endsection
