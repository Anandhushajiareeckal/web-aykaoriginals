@extends('layouts.app')
@section('title', $talent->name . ' — Portfolio')

@section('content')
<style>
    :root {
        --m-bg: #05070a;
        --m-text: #ffffff;
        --m-accent: #c4a47c;
        --m-muted: rgba(255,255,255,0.4);
    }

    /* ── Global Reset ── */
    *, *::before, *::after { box-sizing: border-box; }
    html { scroll-behavior: smooth; -webkit-text-size-adjust: 100%; }
    body {
        background: var(--m-bg) !important;
        color: var(--m-text) !important;
        font-family: 'Inter', sans-serif !important;
        overflow-x: hidden;
        -webkit-font-smoothing: antialiased;
    }
    a { text-decoration: none; color: inherit; }
    img { max-width: 100%; display: block; }

    /* Hide site chrome */
    .site-nav, .site-footer, header:not(.model-nav), footer.site-footer { display: none !important; }

    /* ── Navigation ── */
    .model-nav {
        position: fixed;
        top: 0; left: 0; right: 0;
        height: 70px;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 2rem;
        background: linear-gradient(to bottom, rgba(5,7,10,0.9), transparent);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        transition: all 0.4s ease;
    }
    .model-nav.scrolled {
        background: rgba(5,7,10,0.97);
        height: 60px;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .model-nav .logo {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem;
        letter-spacing: 0.3em;
        font-weight: 500;
        color: #fff;
    }
    .nav-menu {
        display: flex;
        gap: 2rem;
        align-items: center;
    }
    .nav-menu a {
        font-size: 0.6rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--m-muted);
        transition: color 0.3s;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
    }
    .nav-menu a:hover, .nav-menu a:active { color: #fff; }

    /* Mobile nav hamburger → hidden via design */
    .nav-hamburger { display: none; }

    /* ── Hero ── */
    .hero {
        height: 100svh;
        min-height: 600px;
        display: flex;
        align-items: flex-end;
        padding: 0 2rem 5rem;
        position: relative;
        overflow: hidden;
    }
    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }
    .hero-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(5,7,10,0.85) 0%, rgba(5,7,10,0.2) 60%, transparent 100%);
    }
    .hero-bg img {
        width: 100%; height: 100%;
        object-fit: cover;
        object-position: top center;
    }
    .hero-content { position: relative; z-index: 1; }
    .hero-eyebrow {
        font-size: 0.55rem;
        letter-spacing: 0.4em;
        text-transform: uppercase;
        color: var(--m-accent);
        margin-bottom: 1rem;
        display: block;
    }
    .hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(3.5rem, 14vw, 9rem);
        line-height: 0.88;
        font-weight: 300;
        letter-spacing: -0.02em;
    }
    .hero-meta {
        margin-top: 1.5rem;
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        align-items: center;
    }
    .hero-tag {
        font-size: 0.6rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: var(--m-muted);
        padding: 0.4rem 0.8rem;
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 999px;
    }
    .hero-scroll-hint {
        position: absolute;
        bottom: 2rem;
        right: 2rem;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        animation: floatHint 2s ease-in-out infinite;
    }
    .hero-scroll-hint span {
        font-size: 0.5rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--m-muted);
        writing-mode: vertical-lr;
    }
    .hero-scroll-hint div {
        width: 1px;
        height: 50px;
        background: linear-gradient(to bottom, var(--m-accent), transparent);
    }
    @keyframes floatHint {
        0%, 100% { transform: translateY(0); opacity: 0.8; }
        50% { transform: translateY(6px); opacity: 1; }
    }

    /* ── About ── */
    .about-section {
        padding: clamp(5rem, 12vw, 12rem) 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }
    .about-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: clamp(3rem, 8vw, 8rem);
        align-items: start;
    }
    .about-text h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2rem, 5vw, 3.5rem);
        margin-bottom: 1.5rem;
        font-weight: 300;
        line-height: 1.1;
    }
    .about-text p {
        font-size: clamp(0.9rem, 2.5vw, 1.1rem);
        line-height: 1.9;
        color: var(--m-muted);
        margin-bottom: 2.5rem;
    }
    .social-links {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }
    .social-links a {
        font-size: 0.6rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--m-muted);
        transition: color 0.3s;
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .social-links a:hover { color: #fff; }
    .social-links a.accent { color: var(--m-accent); border-color: var(--m-accent); }

    .measurements-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem 2rem;
    }
    .m-pill {
        border-bottom: 1px solid rgba(255,255,255,0.08);
        padding-bottom: 1rem;
    }
    .m-label { font-size: 0.55rem; letter-spacing: 0.25em; text-transform: uppercase; color: var(--m-muted); margin-bottom: 0.4rem; }
    .m-val { font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; font-weight: 300; }

    /* ── Works ── */
    .works-section {
        padding: clamp(4rem, 10vw, 10rem) 2rem clamp(6rem, 14vw, 14rem);
    }
    .works-header {
        text-align: center;
        margin-bottom: clamp(4rem, 8vw, 9rem);
    }
    .section-eyebrow {
        font-size: 0.55rem;
        letter-spacing: 0.5em;
        text-transform: uppercase;
        color: var(--m-accent);
        display: block;
        margin-bottom: 1.5rem;
    }
    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2rem, 6vw, 4rem);
        font-weight: 300;
        line-height: 1.1;
    }
    .work-entry { margin-bottom: clamp(6rem, 14vw, 15rem); }
    .work-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: clamp(3rem, 8vw, 8rem);
        align-items: start;
    }
    .work-info { position: sticky; top: 80px; }
    .work-number {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .work-num-text {
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        font-size: 2rem;
        color: var(--m-accent);
    }
    .work-num-line { height: 1px; flex: 1; background: rgba(255,255,255,0.1); }
    .work-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(1.8rem, 4vw, 3rem);
        margin-bottom: 1.5rem;
        font-weight: 300;
        line-height: 1.2;
    }
    .work-desc { color: var(--m-muted); line-height: 1.9; font-size: 1rem; font-weight: 300; }

    .masonry-wrap { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
    .masonry-item {
        overflow: hidden;
        border-radius: 3px;
        background: #111;
        cursor: pointer;
    }
    .masonry-item img {
        width: 100%; height: 100%;
        object-fit: cover;
        filter: brightness(0.9) contrast(1.05);
        transition: all 1.5s cubic-bezier(0.19, 1, 0.22, 1);
    }
    .masonry-item:hover img { filter: brightness(1); transform: scale(1.06); }
    .masonry-main { grid-column: span 2; aspect-ratio: 4/5; margin-bottom: 1.5rem; }
    .masonry-item:not(.masonry-main) { aspect-ratio: 3/4; }
    .masonry-offset { transform: translateY(3rem); }

    /* ── Contact ── */
    .contact-section {
        padding: clamp(5rem, 12vw, 12rem) 2rem;
        background: #070a11;
    }
    .contact-inner {
        max-width: 1000px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: clamp(3rem, 8vw, 6rem);
        align-items: start;
    }
    .contact-info h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2rem, 5vw, 3.5rem);
        line-height: 1.1;
        margin-bottom: 1.5rem;
        font-weight: 300;
    }
    .contact-info p { color: var(--m-muted); font-size: 0.9rem; line-height: 1.8; }
    .contact-form input,
    .contact-form textarea {
        width: 100%;
        background: transparent;
        border: none;
        border-bottom: 1px solid rgba(255,255,255,0.12);
        padding: 1rem 0;
        color: #fff;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
        outline: none;
        transition: border-color 0.3s;
        -webkit-appearance: none;
        border-radius: 0;
        font-family: 'Inter', sans-serif;
    }
    .contact-form input::placeholder, .contact-form textarea::placeholder { color: rgba(255,255,255,0.25); font-size: 0.7rem; letter-spacing: 0.1em; }
    .contact-form input:focus, .contact-form textarea:focus { border-color: var(--m-accent); }
    .contact-form textarea { resize: none; min-height: 100px; }
    .btn-submit {
        background: var(--m-accent);
        color: #000;
        border: none;
        padding: 1rem 2.5rem;
        font-size: 0.65rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        font-family: 'Inter', sans-serif;
        -webkit-tap-highlight-color: transparent;
        touch-action: manipulation;
        width: 100%;
    }
    .btn-submit:hover, .btn-submit:active { background: #fff; }

    /* ── Footer ── */
    .portfolio-footer {
        padding: 3rem 2rem;
        border-top: 1px solid rgba(255,255,255,0.06);
        text-align: center;
    }
    .portfolio-footer p {
        font-size: 0.55rem;
        letter-spacing: 0.3em;
        color: var(--m-muted);
        text-transform: uppercase;
    }

    /* ─────────────────────────────────
       MOBILE RESPONSIVE MEDIA QUERIES
    ───────────────────────────────── */

    @media (max-width: 768px) {
        /* Nav: minimal on mobile */
        .model-nav { padding: 0 1.25rem; height: 60px; }
        .model-nav.scrolled { height: 55px; }
        .model-nav .logo { font-size: 1.25rem; letter-spacing: 0.25em; }
        .nav-menu { gap: 1.25rem; }
        .nav-menu a { font-size: 0.55rem; }

        /* Hero: full screen feel */
        .hero { padding: 0 1.25rem 4rem; }
        .hero-title { font-size: clamp(3rem, 16vw, 6rem); }
        .hero-scroll-hint { display: none; }
        .hero-meta { gap: 0.75rem; margin-top: 1rem; }

        /* About: stack vertically */
        .about-section { padding: 4rem 1.25rem; }
        .about-grid { grid-template-columns: 1fr; gap: 3rem; }
        .about-text h2 { font-size: clamp(1.8rem, 7vw, 2.5rem); }
        .measurements-grid { grid-template-columns: repeat(3, 1fr); gap: 1rem; }

        /* Works: stack vertically */
        .works-section { padding: 4rem 1.25rem 6rem; }
        .work-grid { grid-template-columns: 1fr !important; gap: 2.5rem !important; }
        .work-info { position: static !important; }
        .order-1, .order-2 { order: 0 !important; }
        .masonry-offset { transform: none; }
        .work-entry { margin-bottom: 5rem; }
        .masonry-wrap { gap: 1rem; }
        .masonry-main { margin-bottom: 1rem; }

        /* Contact: stack */
        .contact-section { padding: 4rem 1.25rem; }
        .contact-inner { grid-template-columns: 1fr; gap: 3rem; }
        .contact-info h2 { font-size: clamp(1.8rem, 7vw, 2.5rem); }
        .btn-submit { padding: 1rem; }

        /* Footer */
        .portfolio-footer { padding: 2rem 1.25rem; }
    }

    @media (max-width: 480px) {
        .nav-menu a { font-size: 0.5rem; letter-spacing: 0.15em; }
        .hero-title { font-size: clamp(2.8rem, 18vw, 4.5rem); }
        .measurements-grid { grid-template-columns: repeat(2, 1fr); }
        .masonry-wrap { gap: 0.75rem; }
    }

    /* Smooth swipe feel */
    @media (hover: none) {
        .masonry-item:hover img { transform: none; filter: brightness(0.9); }
        .btn-submit:hover { background: var(--m-accent); }
    }
</style>

{{-- ── NAVIGATION ── --}}
<nav class="model-nav" id="model-nav">
    <div class="logo">AYKA</div>
    <div class="nav-menu">
        <a href="#about" onclick="smoothScroll('about')">About</a>
        <a href="#works" onclick="smoothScroll('works')">Works</a>
        <a href="#contact" onclick="smoothScroll('contact')">Contact</a>
    </div>
</nav>

{{-- ── HERO ── --}}
<section class="hero">
    <div class="hero-bg">
        @if($talent->hasMedia('cover'))
            <img src="{{ $talent->getFirstMediaUrl('cover', 'large') }}" alt="{{ $talent->name }}" loading="eager">
        @elseif($talent->hasMedia('profile'))
            <img src="{{ $talent->getFirstMediaUrl('profile', 'large') }}" alt="{{ $talent->name }}" loading="eager">
        @endif
    </div>

    <div class="hero-content">
        <span class="hero-eyebrow">AYKA Originals</span>
        <h1 class="hero-title">{{ $talent->name }}</h1>
        <div class="hero-meta">
            @if($talent->category)<span class="hero-tag">{{ $talent->category }}</span>@endif
            @if($talent->location)<span class="hero-tag">{{ $talent->location }}</span>@endif
        </div>
    </div>

    <div class="hero-scroll-hint">
        <div></div>
        <span>Scroll</span>
    </div>
</section>

{{-- ── ABOUT ── --}}
<section class="about-section" id="about">
    <div class="about-grid">
        <div class="about-text">
            <span class="section-eyebrow">Introduction</span>
            <h2>A Vision<br>in Motion</h2>
            <p>{{ $talent->bio ?: "A professional model represented by AYKA Originals, specializing in high-fashion, editorial, and commercial campaigns. With a commitment to excellence and a versatile look, they have worked with leading international brands." }}</p>
            <div class="social-links">
                @if($talent->social_links['instagram'] ?? null)
                    <a href="https://instagram.com/{{ str_replace('@','',$talent->social_links['instagram']) }}" target="_blank" rel="noopener">Instagram ↗</a>
                @endif
                <a href="#contact" class="accent" onclick="smoothScroll('contact')">Booking Inquiry ↘</a>
            </div>
        </div>

        @if($talent->height || $talent->chest_bust || $talent->waist || $talent->hips)
        <div class="measurements-grid">
            @foreach([
                ['Height', 'height'],
                ['Bust', 'chest_bust'],
                ['Waist', 'waist'],
                ['Hips', 'hips'],
                ['Weight', 'weight'],
                ['Inseam', 'inseam'],
                ['Shoes', 'shoe_size'],
                ['Eyes', 'eye_color'],
                ['Hair', 'hair_color'],
            ] as [$l, $k])
                @if($talent->$k)
                <div class="m-pill">
                    <div class="m-label">{{ $l }}</div>
                    <div class="m-val">{{ $talent->$k }}</div>
                </div>
                @endif
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- ── HIGHLIGHT WORKS ── --}}
@php $works = $talent->highlightWorks()->with('media')->get(); @endphp
@if($works->count())
<section class="works-section" id="works">
    <div class="works-header">
        <span class="section-eyebrow">Portfolio Highlights</span>
        <h2 class="section-title">Selected Stories</h2>
    </div>

    @foreach($works as $work)
    <div class="work-entry">
        <div class="work-grid">
            {{-- Info column --}}
            <div class="work-info {{ $loop->even ? 'order-2' : '' }}">
                <div class="work-number">
                    <span class="work-num-text">0{{ $loop->iteration }}</span>
                    <div class="work-num-line"></div>
                </div>
                <h3 class="work-title">{{ $work->title }}</h3>
                @if($work->description)
                <p class="work-desc">{{ $work->description }}</p>
                @endif
            </div>

            {{-- Gallery column --}}
            <div class="work-gallery {{ $loop->even ? 'order-1' : '' }}">
                <div class="masonry-wrap">
                    @foreach($work->getMedia('images') as $media)
                    <div class="masonry-item {{ $loop->first ? 'masonry-main' : ($loop->iteration == 2 ? 'masonry-offset' : '') }}">
                        <img src="{{ $media->getUrl('large') }}" alt="{{ $work->title }}" loading="lazy">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endif

{{-- ── CONTACT ── --}}
<section class="contact-section" id="contact">
    <div class="contact-inner">
        <div class="contact-info">
            <span class="section-eyebrow">Connect</span>
            <h2>Available for<br>Worldwide Projects</h2>
            <p>For bookings, collaborations, or general inquiries, please use the form. AYKA Originals management will get back to you promptly.</p>
        </div>
        <div class="contact-form">
            <form action="{{ route('inquiries.store') }}" method="POST">
                @csrf
                <input type="hidden" name="talent_id" value="{{ $talent->id }}">
                <input type="hidden" name="type" value="talent_booking">
                <input type="text" name="name" placeholder="Your Name" required autocomplete="name">
                <input type="email" name="email" placeholder="Email Address" required autocomplete="email">
                <textarea name="message" rows="4" placeholder="Project Details" required></textarea>
                <button type="submit" class="btn-submit">Send Inquiry</button>
            </form>
        </div>
    </div>
</section>

<footer class="portfolio-footer">
    <p>© {{ date('Y') }} AYKA Originals &nbsp;·&nbsp; {{ $talent->name }}</p>
</footer>

<script>
    // Scroll-aware nav
    const nav = document.getElementById('model-nav');
    window.addEventListener('scroll', () => {
        nav.classList.toggle('scrolled', window.scrollY > 80);
    }, { passive: true });

    // Smooth scroll helper (handles mobile tap)
    function smoothScroll(id) {
        event.preventDefault();
        const el = document.getElementById(id);
        if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // Scroll reveal for work entries
    if ('IntersectionObserver' in window) {
        const revealObs = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    revealObs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -60px 0px' });

        document.querySelectorAll('.work-entry, .masonry-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(40px)';
            el.style.transition = 'opacity 0.9s cubic-bezier(0.19,1,0.22,1), transform 0.9s cubic-bezier(0.19,1,0.22,1)';
            revealObs.observe(el);
        });
    }
</script>
@endsection
