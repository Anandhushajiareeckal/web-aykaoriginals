@extends('layouts.app')
@section('title', 'About AYKA Originals')
@section('description', 'About AYKA Originals — premier talent management agency.')

@section('content')

{{-- ══════════ GSAP & SCROLLTRIGGER ══════════ --}}
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/split-type"></script>
<script>
document.addEventListener("DOMContentLoaded", (event) => {
    gsap.registerPlugin(ScrollTrigger);

    // Hero Text Reveal
    const heroTitle = new SplitType('.hero-title-elite', { types: 'chars' });
    gsap.from(heroTitle.chars, {
        opacity: 0,
        y: 40,
        rotationX: -45,
        stagger: 0.03,
        duration: 1.5,
        ease: "power4.out",
        delay: 0.3
    });

    // Fade up 
    gsap.utils.toArray('.gsap-fade-elite').forEach(elem => {
        gsap.from(elem, {
            scrollTrigger: { trigger: elem, start: "top 90%" },
            y: 40, opacity: 0, duration: 1.2, ease: "expo.out"
        });
    });

    // Parallax background
    gsap.utils.toArray('.gsap-parallax-img').forEach(elem => {
        gsap.to(elem, {
            scrollTrigger: {
                trigger: elem.parentElement,
                start: "top bottom",
                end: "bottom top",
                scrub: true
            },
            y: 30, // move down slightly during scroll
            ease: "none"
        });
    });

    // Interactive Stats Counter
    const statsTrigger = document.querySelector('.stats-section');
    if(statsTrigger) {
        gsap.utils.toArray('.stat-number').forEach(stat => {
            let target = stat.getAttribute('data-target');
            let isPlus = target.includes('+');
            let isEst = stat.getAttribute('data-raw') === '2024';
            let numericVal = parseInt(target.replace(/\D/g,''));
            
            let startVal = isEst ? 2000 : 0;
            let current = { val: startVal };
            
            gsap.to(current, {
                scrollTrigger: { trigger: statsTrigger, start: "top 80%" },
                val: numericVal,
                duration: 2.5,
                ease: "power3.out",
                onUpdate: function() {
                    stat.innerHTML = Math.floor(current.val) + (isPlus ? '+' : '');
                }
            });
        });
    }
});
</script>
@endpush

<style>
/* Custom Elite Aesthetics */
.brand-serif { font-family: 'Cormorant Garamond', serif; }
.brand-sans { font-family: 'Inter', sans-serif; }

.elite-text-gradient {
    background: linear-gradient(135deg, #fff 0%, #a0a5b5 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.elite-watermark {
    position: absolute;
    font-size: clamp(10rem, 25vw, 25rem);
    font-family: 'Cormorant Garamond', serif;
    color: rgba(11, 19, 43, 0.02);
    font-weight: 600;
    line-height: 0.8;
    z-index: 0;
    pointer-events: none;
    white-space: nowrap;
}
.collage-grid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    grid-auto-rows: minmax(min-content, max-content);
    gap: 1rem;
    position: relative;
    z-index: 2;
}

/* Glass & Borders */
.glass-panel-elite {
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(24px);
    border: 1px solid rgba(255, 255, 255, 0.08);
}
.approach-card-elite {
    background: #ffffff;
    border: 1px solid #E4E6F0;
    padding: 3rem 2.5rem;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
}
.approach-card-elite::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, #6C63FF, #8B80FF);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}
.approach-card-elite:hover {
    transform: translateY(-8px);
    box-shadow: 0 30px 60px rgba(11,19,43,0.08);
}
.approach-card-elite:hover::before {
    transform: scaleX(1);
}
.liquid-btn-elite {
    position: relative;
    overflow: hidden;
    transition: color 0.4s ease;
    z-index: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(255,255,255,0.3);
    color: #fff;
    padding: 1.25rem 3.5rem;
    font-size: 0.75rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
}
.liquid-btn-elite::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: #fff;
    z-index: -1;
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform 0.5s cubic-bezier(0.19, 1, 0.22, 1);
}
.liquid-btn-elite:hover::before {
    transform: scaleY(1);
}
.liquid-btn-elite:hover {
    color: #0B132B !important;
}

/* Desktop absolute positioning for collage */
@media (min-width: 1024px) {
    .collage-img-1 { grid-column: 1 / 7; grid-row: 1; margin-top: 2rem; max-width:80%; }
    .collage-text-1 { grid-column: 6 / 13; grid-row: 1; padding: 2rem 0 0 2rem; z-index:3; }
    
    .collage-img-2 { grid-column: 8 / 13; grid-row: 2; margin-top: -3rem; z-index: 3; max-width:90%; }
    .collage-text-2 { grid-column: 2 / 7; grid-row: 2; padding: 4rem 2rem 0 0; text-align: right; }
}
@media (max-width: 1023px) {
    .collage-img-1, .collage-text-1, .collage-img-2, .collage-text-2 {
        grid-column: 1 / -1; grid-row: auto; margin-top: 0; padding: 0; text-align: left !important; margin-bottom: 2rem;
    }
    .collage-img-2 { margin-top: 2rem; }
}

.noise-overlay {
    position: absolute;
    inset: 0;
    background-image: url('data:image/svg+xml,%3Csvg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"%3E%3Cfilter id="noiseFilter"%3E%3CfeTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/%3E%3C/filter%3E%3Crect width="100%25" height="100%25" filter="url(%23noiseFilter)"/%3E%3C/svg%3E');
    opacity: 0.04;
    pointer-events: none;
    z-index: 100;
}
</style>

{{-- ══════════ 1. CINEMATIC HERO SECTION ══════════ --}}
<section style="position:relative;height:70vh;min-height:500px;background:#0B132B;display:flex;align-items:center;justify-content:center;overflow:hidden">
    <div class="noise-overlay"></div>
    
    {{-- Video/Image Background --}}
    <div style="position:absolute;inset:0;width:100%;height:100%;overflow:hidden">
        @if(isset($sections['hero']) && $sections['hero']->video_url)
            <video autoplay muted loop playsinline class="gsap-parallax-img" style="position:absolute;top:-10%;left:0;width:100%;height:120%;object-fit:cover;opacity:0.4;filter:grayscale(100%) contrast(1.2);">
                <source src="{{ $sections['hero']->video_url }}" type="video/mp4">
            </video>
        @else
            <img class="gsap-parallax-img" src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?q=80&w=2070&auto=format&fit=crop" style="position:absolute;top:-10%;left:0;width:100%;height:120%;object-fit:cover;opacity:0.3;filter:grayscale(100%) contrast(1.2);">
        @endif
    </div>

    {{-- Dark fade at bottom --}}
    <div style="position:absolute;inset:0;background:linear-gradient(to top, #0B132B 0%, transparent 40%);"></div>
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at center, transparent 0%, #0B132B 120%);"></div>

    {{-- Content --}}
    <div style="position:relative;z-index:10;text-align:center;padding:0 1.5rem;max-width:1100px;width:100%">
        <h1 class="hero-title-elite brand-serif" style="font-size:clamp(3.5rem, 9vw, 8rem);color:#fff;line-height:0.95;font-weight:400;letter-spacing:-0.03em;">
            {!! nl2br(e($sections['hero']->heading ?? 'About AYKA')) !!}
        </h1>
        <div style="margin-top:2.5rem;display:flex;justify-content:center;align-items:center;gap:1.5rem">
            <div style="height:1px;width:40px;background:rgba(255,255,255,0.3)"></div>
            <p style="font-size:0.6rem;letter-spacing:0.4em;text-transform:uppercase;color:rgba(255,255,255,0.7);font-weight:500;">Est. 2024</p>
            <div style="height:1px;width:40px;background:rgba(255,255,255,0.3)"></div>
        </div>
    </div>
</section>

{{-- ══════════ 2. ASYMMETRICAL EDITORIAL COLLAGE ══════════ --}}
<section style="background:#fff;padding:5rem 1.5rem;position:relative;overflow:hidden">
    <div class="elite-watermark" style="top:5%;left:-5%;">ORIGINALS</div>
    
    <div style="max-width:1440px;margin:0 auto" class="collage-grid">
        
        {{-- Image 1: Tall Portrait --}}
        <div class="collage-img-1 gsap-fade-elite" style="position:relative">
            <div style="aspect-ratio:4/5;overflow:hidden;background:#F4F5FA">
                @if(isset($sections['mission']) && $sections['mission']->image_url)
                    <img src="{{ $sections['mission']->image_url }}" class="gsap-parallax-img" style="width:100%;height:110%;top:-5%;position:absolute;object-fit:cover;object-position:center top;filter:contrast(1.05) grayscale(20%)">
                @else
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=1000&auto=format&fit=crop" class="gsap-parallax-img" style="width:100%;height:110%;top:-5%;position:absolute;object-fit:cover;object-position:center top;filter:contrast(1.05) grayscale(20%)">
                @endif
            </div>
            <div style="position:absolute;bottom:-2rem;right:-2rem;width:120px;height:120px;border:1px solid #E4E6F0;z-index:-1"></div>
        </div>

        {{-- Text 1: Mission --}}
        <div class="collage-text-1 gsap-fade-elite">
            <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem">
                <div style="width:40px;height:1px;background:#0B132B"></div>
                <p style="font-size:0.6rem;letter-spacing:0.3em;text-transform:uppercase;color:#0B132B;font-weight:600">Our Mission</p>
            </div>
            <h2 class="brand-serif" style="font-size:clamp(2.5rem,4vw,3.5rem);color:#0B132B;font-weight:400;margin-bottom:2rem;line-height:1.1;letter-spacing:-0.01em">
                {{ $sections['mission']->heading ?? 'Defining the New Standard.' }}
            </h2>
            <div style="font-size:0.9rem;color:#5E6472;line-height:2.2;font-weight:300">
                {!! nl2br(e($sections['mission']->body ?? 'AYKA Originals is a premier boutique talent management agency. We discover, develop, and manage extraordinary faces for the world\'s leading luxury, editorial, and commercial brands.')) !!}
            </div>
        </div>

        {{-- Text 2: Vision --}}
        <div class="collage-text-2 gsap-fade-elite">
            <h2 class="brand-serif" style="font-size:clamp(2.5rem,4vw,3.5rem);color:#0B132B;font-weight:400;margin-bottom:2rem;line-height:1.1;letter-spacing:-0.01em">
                {{ $sections['vision']->heading ?? 'Shaping Culture.' }}
            </h2>
            <div style="font-size:0.9rem;color:#5E6472;line-height:2.2;font-weight:300">
                {!! nl2br(e($sections['vision']->body ?? 'We believe in a highly personalized approach to career building. Beyond simply booking jobs, we cultivate long-term iconic status for our talent on global stages.')) !!}
            </div>
            <div style="display:flex;align-items:center;gap:1rem;margin-top:2rem;justify-content:flex-end" class="lg:justify-end justify-start">
                <p style="font-size:0.6rem;letter-spacing:0.3em;text-transform:uppercase;color:#0B132B;font-weight:600">Our Vision</p>
                <div style="width:40px;height:1px;background:#0B132B"></div>
            </div>
        </div>

        {{-- Image 2: Wide Landscape overlapping --}}
        <div class="collage-img-2 gsap-fade-elite" style="position:relative">
            <div style="aspect-ratio:4/3;overflow:hidden;background:#F4F5FA;box-shadow: -20px 20px 60px rgba(11,19,43,0.1)">
                @if(isset($sections['vision']) && $sections['vision']->image_url)
                    <img src="{{ $sections['vision']->image_url }}" style="width:100%;height:100%;position:absolute;top:0;left:0;object-fit:cover;object-position:center;filter:contrast(1.1) grayscale(10%)">
                @else
                    <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?q=80&w=1000&auto=format&fit=crop" style="width:100%;height:100%;position:absolute;top:0;left:0;object-fit:cover;object-position:center top;filter:contrast(1.1) grayscale(10%)">
                @endif
            </div>
        </div>

    </div>
</section>

{{-- ══════════ 3. ANIMATED STATS SECTION ══════════ --}}
<section class="stats-section" style="background:#0B132B;padding:8rem 1.5rem;position:relative;overflow:hidden;border-top:1px solid rgba(255,255,255,0.05)">
    <div class="noise-overlay"></div>
    <div style="position:absolute;top:0;left:0;right:0;height:400px;background:radial-gradient(ellipse at top, rgba(108,99,255,0.15), transparent 70%);pointer-events:none;"></div>
    
    <div style="max-width:1440px;margin:0 auto;position:relative;z-index:2">
        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(220px, 1fr));gap:1px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08)">
            @foreach([
                [\App\Models\SiteSetting::get('stats_count_1', '13+'), \App\Models\SiteSetting::get('stats_label_1', 'Represented Talents')],
                [\App\Models\SiteSetting::get('stats_count_2', '4+'), \App\Models\SiteSetting::get('stats_label_2', 'Campaigns Produced')],
                [\App\Models\SiteSetting::get('stats_count_4', '2024'), \App\Models\SiteSetting::get('stats_label_4', 'Established In')],
                [\App\Models\SiteSetting::get('stats_count_3', '12+'), \App\Models\SiteSetting::get('stats_label_3', 'Global Presence')]
            ] as $s)
            @if($s[0] && $s[1])
            <div class="gsap-fade-elite" style="padding:4rem 2rem;text-align:center;background:#0B132B;background-clip:padding-box;border:1px solid transparent;transition:background 0.3s" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='#0B132B'">
                <p class="stat-number elite-text-gradient brand-serif" data-target="{{ $s[0] }}" data-raw="{{ $s[0] }}" style="font-size:clamp(3rem, 5vw, 4rem);font-weight:400;line-height:1;margin-bottom:0.75rem">
                    0
                </p>
                <p style="font-size:0.6rem;letter-spacing:0.25em;text-transform:uppercase;color:rgba(255,255,255,0.4);font-weight:500;">{{ $s[1] }}</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════ 4. REFINED APPROACH / CORE VALUES ══════════ --}}
<section style="background:#F4F5FA;padding:10rem 1.5rem;position:relative;overflow:hidden">
    <div class="elite-watermark" style="bottom:-5%;right:-10%;color:rgba(11,19,43,0.03);text-align:right">VALUES</div>
    
    <div style="max-width:1440px;margin:0 auto;position:relative;z-index:2">
        <div class="gsap-fade-elite" style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:2rem;margin-bottom:6rem">
            <div style="max-width:500px">
                <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem">
                    <div style="width:40px;height:1px;background:#0B132B"></div>
                    <p style="font-size:0.6rem;letter-spacing:0.3em;text-transform:uppercase;color:#0B132B;font-weight:600">The Framework</p>
                </div>
                <h2 class="brand-serif" style="font-size:clamp(2.5rem,4vw,3.5rem);color:#0B132B;font-weight:400;line-height:1.1;letter-spacing:-0.01em">Core Principles</h2>
            </div>
            <p style="font-size:0.85rem;color:#5E6472;max-width:400px;line-height:1.9;font-weight:300">
                The foundational principles that guide how we nurture talent and partner with global brands. We don't just follow trends; we set the standard.
            </p>
        </div>
        
        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(320px, 1fr));gap:2rem">
            {{-- Value 1 --}}
            <div class="gsap-fade-elite approach-card-elite">
                <span style="font-family:'Cormorant Garamond',serif;font-size:5rem;color:rgba(11,19,43,0.05);position:absolute;top:-10px;right:20px;font-weight:600;pointer-events:none">01</span>
                <h3 class="brand-serif" style="font-size:1.75rem;color:#0B132B;margin-bottom:1.25rem;font-weight:500">Curated Exclusivity</h3>
                <p style="font-size:0.85rem;color:#5E6472;line-height:1.9;font-weight:300">We meticulously curate our board, focusing on bespoke management for a select few rather than volume representation.</p>
            </div>
            {{-- Value 2 --}}
            <div class="gsap-fade-elite approach-card-elite" style="animation-delay:0.1s">
                <span style="font-family:'Cormorant Garamond',serif;font-size:5rem;color:rgba(11,19,43,0.05);position:absolute;top:-10px;right:20px;font-weight:600;pointer-events:none">02</span>
                <h3 class="brand-serif" style="font-size:1.75rem;color:#0B132B;margin-bottom:1.25rem;font-weight:500">Visionary Development</h3>
                <p style="font-size:0.85rem;color:#5E6472;line-height:1.9;font-weight:300">Our approach identifies unique raw potential and transforms it into highly coveted, industry-leading iconic brands.</p>
            </div>
            {{-- Value 3 --}}
            <div class="gsap-fade-elite approach-card-elite" style="animation-delay:0.2s">
                <span style="font-family:'Cormorant Garamond',serif;font-size:5rem;color:rgba(11,19,43,0.05);position:absolute;top:-10px;right:20px;font-weight:600;pointer-events:none">03</span>
                <h3 class="brand-serif" style="font-size:1.75rem;color:#0B132B;margin-bottom:1.25rem;font-weight:500">Global Reach</h3>
                <p style="font-size:0.85rem;color:#5E6472;line-height:1.9;font-weight:300">With strategic partnerships spanning the fashion capitals, we place our talent on the highest international stages.</p>
            </div>
        </div>
    </div>
</section>

{{-- ══════════ 5. GLOBAL BRAND CTA ══════════ --}}
<section style="background:#0B132B;padding:10rem 1.5rem;text-align:center;position:relative;overflow:hidden">
    <div class="noise-overlay"></div>
    <div style="position:absolute;inset:0;background-image:url('https://images.unsplash.com/photo-1600096194534-95cf5ece04cf?q=80&w=2000&auto=format&fit=crop');background-size:cover;background-position:center;opacity:0.15;mix-blend-mode:luminosity;"></div>
    
    <div style="max-width:800px;margin:0 auto;position:relative;z-index:10" class="gsap-fade-elite">
        <h2 class="brand-serif" style="font-size:clamp(3.5rem,7vw,5.5rem);color:#fff;font-weight:400;margin-bottom:2rem;line-height:1;letter-spacing:-0.02em">
            {{ $sections['cta']->heading ?? 'Join the Vanguard.' }}
        </h2>
        <p style="font-size:0.9rem;color:rgba(255,255,255,0.6);margin-bottom:3.5rem;max-width:500px;margin-left:auto;margin-right:auto;font-weight:300;line-height:1.9">
            Discover what it means to be represented by a team that prioritizes elite craft and distinct vision.
        </p>
        <a href="{{ route('inquiries.create') }}" class="liquid-btn-elite">
            <span>{{ $sections['cta']->btn1_label ?? 'Submit Inquiry' }}</span>
        </a>
    </div>
</section>

@endsection
