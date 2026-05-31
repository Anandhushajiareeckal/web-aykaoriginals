@extends('layouts.app')
@section('title', $talent->name . ' — Portfolio')
@section('description', $talent->bio ? Str::limit($talent->bio,160) : $talent->name.' — represented by AYKA Originals.')

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    gsap.registerPlugin(ScrollTrigger);

    // Fade in metrics
    gsap.from('.metric-badge', { opacity: 0, y: 10, stagger: 0.1, duration: 1, ease: 'power3.out', delay: 0.5 });
    gsap.from('.stat-box', { opacity: 0, y: 20, stagger: 0.1, duration: 1, ease: 'power3.out', delay: 1 });

    // Animate Gauge
    const gauge = document.querySelector('.gauge-fill');
    if (gauge) {
        gsap.to(gauge, { strokeDashoffset: 140 - (140 * 0.74), duration: 2, delay: 1, ease: 'power4.out' });
    }

    // Scroll gallery
    gsap.utils.toArray('.gallery-item').forEach((item, i) => {
        gsap.from(item, {
            scrollTrigger: { trigger: item, start: 'top 90%' },
            opacity: 0, y: 30, duration: 0.8, delay: (i%3)*0.1
        });
    });
});
</script>

<style>
    :root {
        --b-dark: #090e17;
        --b-card: rgba(255, 255, 255, 0.03);
        --b-border: rgba(255, 255, 255, 0.08);
        --accent: #ff4757; /* TikTok red vibe */
    }

    body { background: var(--b-dark) !important; color: #fff !important; }

    /* LAYOUT */
    .show-wrapper { display: grid; grid-template-columns: 1fr 400px; max-width: 1600px; margin: 0 auto; min-height: 100vh; padding-top: 72px; }
    
    @media (max-width: 1024px) {
        .show-wrapper { grid-template-columns: 1fr; }
    }

    /* LEFT: MEDIA & HERO */
    .media-col { padding: 2rem; border-right: 1px solid var(--b-border); position: relative; }
    .hero-container { position: sticky; top: 100px; border-radius: 16px; overflow: hidden; aspect-ratio: 4/3; max-height: 500px; background: #000; box-shadow: 0 20px 60px rgba(0,0,0,0.5); }
    .hero-img { width: 100%; height: 100%; object-fit: cover; filter: contrast(1.05) saturate(1.1); display: block; }
    
    /* OVERLAY WIDGETS (Like the Reel) */
    .metric-badge { position: absolute; background: rgba(255,255,255,0.85); backdrop-filter: blur(10px); color: #000; padding: 6px 12px; border-radius: 20px; font-size: 0.65rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); font-family: 'Inter', sans-serif; letter-spacing: 0.05em; }
    
    .metric-badge.left-eye { top: 30%; left: 15%; }
    .metric-badge.right-eye { top: 30%; right: 15%; }
    .metric-badge.nose { top: 45%; left: 10%; }
    .metric-badge.jaw { bottom: 15%; right: 10%; }
    
    /* RIGHT: DATA & STATS */
    .data-col { padding: 2rem; display: flex; flex-direction: column; overflow-y: auto; }
    .data-nav { display: flex; gap: 1.5rem; border-bottom: 1px solid var(--b-border); padding-bottom: 1rem; margin-bottom: 2rem; }
    .data-nav-item { font-size: 0.75rem; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer; transition: color 0.3s; }
    .data-nav-item.active { color: #fff; border-bottom: 2px solid #fff; padding-bottom: 1rem; margin-bottom: -1rem; }
    
    .name-heading { font-family: 'Cormorant Garamond', serif; font-size: 3rem; font-weight: 300; line-height: 1; margin-bottom: 0.5rem; }
    .sub-heading { font-size: 0.75rem; color: var(--accent); letter-spacing: 0.25em; text-transform: uppercase; margin-bottom: 2rem; }
    
    .tab-content { display: none; animation: fadeIn 0.4s ease; }
    .tab-content.active { display: block; }
    
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px) } to { opacity: 1; transform: translateY(0) } }

    /* TIKTOK STYLE GAUGE */
    .score-container { display: flex; flex-direction: column; align-items: center; margin-bottom: 3rem; padding: 2rem; background: var(--b-card); border-radius: 16px; border: 1px solid var(--b-border); }
    .gauge { position: relative; width: 120px; height: 60px; overflow: hidden; margin-bottom: 1rem; }
    .gauge svg { width: 120px; height: 120px; transform: rotate(-90deg); position: absolute; }
    .gauge-bg { fill: none; stroke: rgba(255,255,255,0.1); stroke-width: 8; stroke-linecap: round; }
    .gauge-fill { fill: none; stroke: url(#gradient); stroke-width: 8; stroke-linecap: round; stroke-dasharray: 140; stroke-dashoffset: 140; }
    .score-text { position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); font-family: 'Inter', sans-serif; font-size: 2rem; font-weight: 700; color: #fff; line-height: 1; }
    .score-sub { font-size: 0.6rem; color: rgba(255,255,255,0.4); letter-spacing: 0.1em; text-transform: uppercase; margin-top: 0.5rem; display: flex; align-items: center; gap: 4px; }
    
    /* STATS GRID */
    .demographics-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 3rem; }
    .stat-box { background: var(--b-card); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--b-border); text-align: center; }
    .stat-box-lbl { font-size: 0.6rem; color: rgba(255,255,255,0.4); letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 1rem; }
    .stat-box-val { font-size: 1.25rem; font-weight: 600; font-family: 'Inter', sans-serif; color: #fff; }
    .stat-box-hl { color: var(--accent); }
    .progress-bar { height: 4px; background: rgba(255,255,255,0.1); border-radius: 4px; margin-top: 0.75rem; overflow: hidden; }
    .progress-fill { height: 100%; background: linear-gradient(90deg, #ff4757, #ff6b81); border-radius: 4px; }

    /* MEASUREMENTS COMPACT */
    .meas-row { display: flex; justify-content: space-between; padding: 0.85rem 0; border-bottom: 1px dashed var(--b-border); font-size: 0.8rem; }
    .meas-row:last-child { border-bottom: none; }
    .meas-lbl { color: rgba(255,255,255,0.5); }
    .meas-val { font-family: monospace; font-size: 0.85rem; color: #fff; }

    /* ACTION BUTTON */
    .btn-action { display: flex; align-items: center; justify-content: center; width: 100%; padding: 1.2rem; background: #fff; color: #000; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; border-radius: 8px; margin-top: 2rem; transition: background 0.3s; text-decoration: none; }
    .btn-action:hover { background: #f0f0f0; }

    /* GALLERY ROW */
    .gallery-row { display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem; margin-top: 2rem; }
    .gallery-item { aspect-ratio: 3/4; border-radius: 8px; overflow: hidden; border: 1px solid var(--b-border); cursor: pointer; }
    .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
    .gallery-item:hover img { transform: scale(1.05); }

    /* FORM STYLES */
    .inquiry-form input, .inquiry-form textarea { width: 100%; background: var(--b-card); border: 1px solid var(--b-border); color: #fff; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; font-size: 0.85rem; font-family: 'Inter', sans-serif; }
    .inquiry-form input:focus, .inquiry-form textarea:focus { outline: none; border-color: rgba(255,255,255,0.3); }
</style>

@section('content')
<div class="show-wrapper">
    
    {{-- LEFT: VISUAL --}}
    <div class="media-col">
        <div class="hero-container">
            @if($talent->hasMedia('profile') || $talent->hasMedia('cover'))
                <img src="{{ $talent->getFirstMediaUrl('profile','large') ?: $talent->getFirstMediaUrl('cover','large') }}" class="hero-img" alt="{{ $talent->name }}">
            @else
                <div style="width:100%;height:100%;background:#111;display:flex;align-items:center;justify-content:center"><span style="color:#fff">No Image</span></div>
            @endif

            {{-- Facial Analysis Badges (Simulated AI Overlays) --}}
            <div class="metric-badge left-eye">
                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg> 0°
            </div>
            <div class="metric-badge right-eye">Medium</div>
            <div class="metric-badge nose">
                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg> Convex
            </div>
            <div class="metric-badge jaw">
                139° <div style="width:8px;height:8px;background:var(--accent);border-radius:50%"></div>
            </div>
        </div>

        {{-- Gallery Strip --}}
        @php $gallery = $talent->getMedia('portfolio'); @endphp
        @if($gallery->count())
        <div class="gallery-row">
            @foreach($gallery->take(4) as $media)
            <div class="gallery-item" onclick="openLightbox('{{ $media->getUrl('large') }}')">
                <img src="{{ $media->getUrl('medium') }}" loading="lazy">
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- RIGHT: DATA --}}
    <div class="data-col">
        <div class="data-nav">
            <span class="data-nav-item active" onclick="switchTab('overview', this)">Overview</span>
            <span class="data-nav-item" onclick="switchTab('measurements', this)">Measurements</span>
            <span class="data-nav-item" onclick="switchTab('booking', this)">Booking</span>
        </div>

        <div id="overview" class="tab-content active">
        <h1 class="name-heading">{{ $talent->name }}</h1>
        <p class="sub-heading">Global {{ $talent->category }} &bull; {{ $talent->location ?? 'INTL' }}</p>

        {{-- Aesthetic Score Card --}}
        <div class="score-container">
            <div class="gauge">
                <svg viewBox="0 0 100 100">
                    <defs>
                        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#ff9a9e" />
                            <stop offset="100%" stop-color="#fecfef" />
                        </linearGradient>
                    </defs>
                    <circle class="gauge-bg" cx="50" cy="50" r="45" />
                    <!-- stroke-dasharray = 2*PI*45 / 2 = ~141. We use 140 -->
                    <circle class="gauge-fill" cx="50" cy="50" r="45" />
                </svg>
                <div class="score-text">
                    {{ number_format(rand(70,95)/10, 1) }}<span style="font-size:1rem;color:rgba(255,255,255,0.4)">/10</span>
                </div>
            </div>
            <div class="score-sub">
                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> AYKA AI Score
            </div>
        </div>

        {{-- Demographic breakdown (Simulated Stats) --}}
        <div class="demographics-grid">
            <div class="stat-box">
                <div class="stat-box-lbl">Percentile</div>
                <div class="stat-box-val">{{ rand(88,99) }}nd</div>
                <div class="progress-bar"><div class="progress-fill" style="width:{{ rand(88,99) }}%"></div></div>
            </div>
            <div class="stat-box">
                <div class="stat-box-lbl">Primary Market</div>
                <div class="stat-box-val">{{ ['Europe', 'Americas', 'Asia-Pacific', 'Global'][array_rand(['Europe', 'Americas', 'Asia-Pacific', 'Global'])] }}</div>
                <div class="progress-bar"><div class="progress-fill" style="width:{{ rand(70,95) }}%;background:linear-gradient(90deg, #74ebd5, #ACB6E5)"></div></div>
            </div>
        </div>
        </div>

        {{-- Core Measurements --}}
        <div id="measurements" class="tab-content" style="background:var(--b-card);border:1px solid var(--b-border);border-radius:12px;padding:1.5rem;margin-bottom:2.5rem;">
            <h3 style="font-family:'Inter',sans-serif;font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--accent);margin-bottom:1.5rem">Physical Attributes</h3>
            
            @foreach([
                ['Height', $talent->height],
                ['Bust/Chest', $talent->chest_bust],
                ['Waist', $talent->waist],
                ['Hips', $talent->hips],
                ['Shoes', $talent->shoe_size],
                ['Hair', $talent->hair_color],
                ['Eyes', $talent->eye_color]
            ] as [$lbl, $val])
                @if($val)
                <div class="meas-row">
                    <span class="meas-lbl">{{ $lbl }}</span>
                    <span class="meas-val">{{ $val }}</span>
                </div>
                @endif
            @endforeach
        </div>

        {{-- Quick Bio --}}
        @if($talent->bio)
        <div style="margin-bottom: 2.5rem; color: rgba(255,255,255,0.6); font-size: 0.9rem; line-height: 1.7; font-weight: 300;">
            {!! nl2br(e($talent->bio)) !!}
        </div>
        @endif

        {{-- Booking Form --}}
        <div id="booking" class="tab-content" style="background:var(--b-card);border:1px solid var(--b-border);border-radius:12px;padding:2rem;">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:1.5rem">
                <div style="width:10px;height:10px;background:#2ecc71;border-radius:50%;box-shadow:0 0 10px #2ecc71"></div>
                <span style="font-family:'Inter',sans-serif;font-size:0.75rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Available for Booking</span>
            </div>
            
            <form method="POST" action="{{ route('inquiries.store') }}" class="inquiry-form">
                @csrf
                <input type="hidden" name="talent_id" value="{{ $talent->id }}">
                <input type="hidden" name="type" value="talent_booking">
                
                <input type="text" name="name" required placeholder="Brand / Agency Name">
                <input type="email" name="email" required placeholder="Official Email">
                <textarea name="message" required rows="3" placeholder="Project details, timeline & usage..."></textarea>
                
                <button type="submit" class="btn-action">Submit Inquiry Request</button>
            </form>
        </div>

    </div>
</div>

{{-- Lightbox Modal --}}
<div id="lightbox" style="position:fixed;inset:0;background:rgba(0,0,0,0.95);z-index:9999;display:none;align-items:center;justify-content:center;padding:2rem;" onclick="this.style.display='none'">
    <img id="lightbox-img" src="" style="max-width:100%;max-height:100%;object-fit:contain;">
</div>

<script>
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').style.display = 'flex';
}

function switchTab(id, element) {
    // Nav styling
    document.querySelectorAll('.data-nav-item').forEach(el => el.classList.remove('active'));
    element.classList.add('active');
    
    // Tab content switching
    document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
    document.getElementById(id).classList.add('active');
}
</script>
@endsection
