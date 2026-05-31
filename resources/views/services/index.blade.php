@extends('layouts.app')
@section('title', 'Services')
@section('description', 'AYKA Originals — talent management, campaign production, editorial direction and brand consulting.')

@section('content')

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/split-type"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    gsap.registerPlugin(ScrollTrigger);

    // Hero title char reveal
    const title = new SplitType('.svc-hero-title', { types: 'chars' });
    gsap.from(title.chars, { opacity: 0, y: 50, rotationX: -50, stagger: 0.025, duration: 1.1, ease: 'power4.out', delay: 0.2 });
    gsap.from('.svc-hero-sub', { opacity: 0, y: 20, duration: 1, ease: 'power3.out', delay: 0.9 });

    // Cards
    gsap.utils.toArray('.svc-card').forEach((card, i) => {
        gsap.from(card, {
            scrollTrigger: { trigger: card, start: 'top 88%' },
            opacity: 0, y: 50, duration: 0.9, ease: 'expo.out', delay: (i % 3) * 0.08
        });
    });

    // Process steps
    gsap.utils.toArray('.process-step').forEach((step, i) => {
        gsap.from(step, {
            scrollTrigger: { trigger: step, start: 'top 88%' },
            opacity: 0, y: 30, duration: 0.8, ease: 'power3.out', delay: i * 0.1
        });
    });

    gsap.from('.svc-cta-inner', {
        scrollTrigger: { trigger: '.svc-cta-inner', start: 'top 85%' },
        opacity: 0, scale: 0.96, duration: 1, ease: 'expo.out'
    });

    // Card hover tilt
    document.querySelectorAll('.svc-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            gsap.to(card, { rotationY: x * 6, rotationX: -y * 6, transformPerspective: 900, ease: 'power1.out', duration: 0.35 });
        });
        card.addEventListener('mouseleave', () => {
            gsap.to(card, { rotationY: 0, rotationX: 0, duration: 0.7, ease: 'elastic.out(1, 0.5)' });
        });
    });
});
</script>
@endpush

<style>
/* ─── Site-consistent palette ─── */
/* Hero: matches #0B132B navy from home/about   */
/* Cards: white on light #F4F5FA bg             */
/* Dark sections: #0B132B                       */
/* Accent: #6C63FF                              */

.svc-brand-serif { font-family: 'Cormorant Garamond', serif; }

/* Marquee */
.marquee-outer { overflow: hidden; white-space: nowrap; background: #6C63FF; padding: 0.65rem 0; }
.marquee-track { display: inline-flex; animation: marquee-scroll 28s linear infinite; }
.marquee-track span { padding: 0 2rem; font-size: 0.6rem; letter-spacing: 0.25em; text-transform: uppercase; color: rgba(255,255,255,0.85); font-weight: 600; }
@keyframes marquee-scroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }

/* Service card — white card, consistent with the site */
.svc-card {
    background: #fff;
    border: 1px solid #E4E6F0;
    border-radius: 0;
    overflow: hidden;
    transform-style: preserve-3d;
    transition: box-shadow 0.5s ease, border-color 0.4s ease;
    will-change: transform;
    position: relative;
}
.svc-card:hover {
    box-shadow: 0 20px 50px rgba(11,19,43,0.1);
    border-color: rgba(108,99,255,0.3);
}
.svc-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, #6C63FF, #8B80FF);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}
.svc-card:hover::after { transform: scaleX(1); }

.svc-card-img {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
    filter: grayscale(60%) contrast(1.05);
    transition: filter 0.5s ease, transform 0.5s ease;
}
.svc-card:hover .svc-card-img {
    filter: grayscale(10%) contrast(1.0);
    transform: scale(1.03);
}
.svc-tag {
    display: inline-block;
    font-size: 0.58rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: #6C63FF;
    font-weight: 600;
    margin-bottom: 0.75rem;
}
.svc-enquire-link {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.65rem;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #0B132B;
    margin-top: 1.25rem;
    text-decoration: none;
    font-weight: 600;
    border-bottom: 1px solid #E4E6F0;
    padding-bottom: 2px;
    transition: color 0.3s, border-color 0.3s;
}
.svc-enquire-link:hover { color: #6C63FF; border-color: #6C63FF; }

/* Process step circle */
.process-num {
    width: 3rem;
    height: 3rem;
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: border-color 0.3s, background 0.3s;
}
.process-step:hover .process-num {
    border-color: #6C63FF;
    background: rgba(108,99,255,0.1);
}
</style>

{{-- ═══ 1. HERO — matches site #0B132B palette ═══ --}}
@php $hero = $sections->get('hero'); @endphp
<section style="position:relative;height:75vh;min-height:550px;background:#0B132B;display:flex;align-items:center;justify-content:center;overflow:hidden">
    @if($hero?->video_url)
    <video autoplay muted loop playsinline style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0.25;mix-blend-mode:luminosity;"><source src="{{ $hero->video_url }}" type="video/mp4"></video>
    @elseif($hero?->image_url)
    <div style="position:absolute;inset:0;background-image:url('{{ $hero->image_url }}');background-size:cover;background-position:center;opacity:0.25;mix-blend-mode:luminosity;"></div>
    @else
    <div style="position:absolute;inset:0;background-image:url('https://images.unsplash.com/photo-1509631179647-0c1157db18c4?q=80&w=2000&auto=format&fit=crop');background-size:cover;background-position:center;opacity:0.12;mix-blend-mode:luminosity;"></div>
    @endif
    
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 30% 50%,rgba(108,99,255,.18) 0%,transparent 60%);pointer-events:none"></div>
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 80% 20%,rgba(6,182,212,.08) 0%,transparent 55%);pointer-events:none"></div>
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom, transparent 50%, #0B132B 110%);pointer-events:none"></div>

    <div style="position:relative;z-index:2;text-align:center;padding:0 1.5rem;max-width:900px;width:100%">
        <div style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);padding:.4rem 1.2rem;border-radius:999px;margin-bottom:2rem;backdrop-filter:blur(8px)">
            <span style="width:6px;height:6px;border-radius:50%;background:#6C63FF;display:inline-block"></span>
            <span style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.7)">{{ $hero?->subheading ?? 'What We Offer' }}</span>
        </div>
        <h1 class="svc-hero-title svc-brand-serif" style="font-size:clamp(3.5rem,8vw,7rem);color:#fff;line-height:0.95;font-weight:400;letter-spacing:-0.02em">
            {!! $hero?->heading ?? 'Our <em style="font-style:italic;opacity:.8">Services</em>' !!}
        </h1>
        <p class="svc-hero-sub" style="margin-top:2rem;font-size:0.9rem;color:rgba(255,255,255,0.5);max-width:450px;margin-left:auto;margin-right:auto;line-height:1.9;font-weight:300">
            {{ $hero?->body ?? 'From talent representation to global campaigns — we deliver at every stage of the creative journey.' }}
        </p>
    </div>
</section>

{{-- ═══ 2. MARQUEE ═══ --}}
<div class="marquee-outer">
    <div class="marquee-track">
        @foreach(['Talent Management', '✦', 'Campaign Production', '✦', 'Editorial Direction', '✦', 'Brand Consulting', '✦', 'Talent Management', '✦', 'Campaign Production', '✦', 'Editorial Direction', '✦', 'Brand Consulting', '✦'] as $item)
            <span>{{ $item }}</span>
        @endforeach
    </div>
</div>

{{-- ═══ 3. SERVICE CARDS — white cards on light bg ═══ --}}
<section style="background:#F4F5FA;padding:8rem 1.5rem">
    <div style="max-width:1440px;margin:0 auto">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:5rem">
            <div>
                <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1rem">
                    <div style="width:40px;height:1px;background:#0B132B"></div>
                    <p style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:#0B132B;font-weight:600">Everything You Need</p>
                </div>
                <h2 class="svc-brand-serif" style="font-size:clamp(2rem,3vw,3rem);color:#0B132B;font-weight:400;letter-spacing:-0.01em">Built for your success.</h2>
            </div>
            <a href="{{ route('inquiries.create') }}" style="font-size:.7rem;letter-spacing:.15em;text-transform:uppercase;color:#5E6472;text-decoration:none;border-bottom:1px solid #E4E6F0;padding-bottom:2px">Get Started →</a>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:2rem">
            @forelse($services as $i => $service)
            <div class="svc-card">
                {{-- Image --}}
                @if($service->image_url)
                <div style="overflow:hidden">
                    <img src="{{ $service->image_url }}" class="svc-card-img" alt="{{ $service->title }}">
                </div>
                @else
                <div style="width:100%;aspect-ratio:16/9;background:linear-gradient(135deg,#F4F5FA,#E8E9F0);display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden">
                    <span class="svc-brand-serif" style="font-size:7rem;color:rgba(11,19,43,0.04);font-weight:600;position:absolute;user-select:none">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
                    @php
                        $icons = ['star'=>'M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z','camera'=>'M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z M12 17a4 4 0 100-8 4 4 0 000 8z','edit'=>'M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7 M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z','briefcase'=>'M20 7H4a2 2 0 00-2 2v4a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2'];
                        $d = $icons[$service->icon] ?? $icons['star'];
                    @endphp
                    <svg style="width:40px;height:40px;stroke:#0B132B;opacity:.2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $d }}"/></svg>
                </div>
                @endif

                <div style="padding:2rem">
                    <span class="svc-tag">{{ $service->tag ?? 'Service '.str_pad($i+1,2,'0',STR_PAD_LEFT) }}</span>
                    <h3 class="svc-brand-serif" style="font-size:1.6rem;color:#0B132B;font-weight:400;margin-bottom:.75rem;line-height:1.2">{{ $service->title }}</h3>
                    <p style="font-size:.85rem;color:#5E6472;line-height:1.9;font-weight:300">{{ $service->description }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="svc-enquire-link">
                        View Details <svg style="width:12px;height:12px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1;padding:6rem 0;text-align:center">
                <p class="svc-brand-serif" style="font-size:2rem;color:#8B90A0">Services coming soon.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ═══ 4. HOW IT WORKS — fully dynamic ═══ --}}
@php
    $procHead = $sections->get('process_heading');
    $steps = [
        $sections->get('process_1'),
        $sections->get('process_2'),
        $sections->get('process_3'),
        $sections->get('process_4')
    ];
@endphp
<section style="background:#0B132B;padding:8rem 1.5rem">
    <div style="max-width:1440px;margin:0 auto;text-align:center">

        {{-- Section heading --}}
        <div style="margin-bottom:5rem">
            <div style="display:flex;align-items:center;justify-content:center;gap:1rem;margin-bottom:1.25rem">
                <div style="width:40px;height:1px;background:rgba(255,255,255,0.2)"></div>
                <span style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.5);font-weight:600">{{ $procHead?->subheading ?? 'How It Works' }}</span>
                <div style="width:40px;height:1px;background:rgba(255,255,255,0.2)"></div>
            </div>
            <h2 class="svc-brand-serif" style="font-size:clamp(2.5rem,4vw,4rem);color:#fff;font-weight:400;line-height:1.05;letter-spacing:-0.02em">{!! $procHead?->heading ?? 'Our Process<br><em style="opacity:.6">Is Simple.</em>' !!}</h2>
            <p style="margin-top:1.5rem;font-size:.88rem;color:rgba(255,255,255,.4);max-width:450px;margin-left:auto;margin-right:auto;line-height:1.9;font-weight:300">{{ $procHead?->body ?? 'From the first conversation to global recognition — our structured approach ensures every talent reaches their full potential.' }}</p>
        </div>

        {{-- 4-column dynamic grid --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:2.5rem;max-width:1000px;margin:0 auto">
            @foreach($steps as $i => $step)
            @if($step)
            <div class="process-step" style="text-align:center;padding:2.5rem 1.5rem;border:1px solid rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);transition:background 0.3s,border-color 0.3s" onmouseover="this.style.background='rgba(108,99,255,0.08)';this.style.borderColor='rgba(108,99,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.02)';this.style.borderColor='rgba(255,255,255,0.06)'">
                <div class="process-num" style="margin:0 auto 1.5rem">
                    <span style="font-size:.62rem;font-weight:700;color:#6C63FF;letter-spacing:.1em">{{ $step->subheading ?? str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
                <p style="font-size:1.4rem;color:#fff;margin-bottom:.6rem;font-family:'Cormorant Garamond',serif;font-weight:400">{{ $step->heading }}</p>
                <p style="font-size:.8rem;color:rgba(255,255,255,.4);line-height:1.8;font-weight:300">{{ $step->body }}</p>
            </div>
            @endif
            @endforeach
        </div>

    </div>
</section>

{{-- ═══ 5. CTA — consistent with home/about dark CTA ═══ --}}
<section style="background:#fff;padding:8rem 1.5rem;text-align:center;border-top:1px solid #E4E6F0">
    <div class="svc-cta-inner" style="max-width:700px;margin:0 auto">
        <div style="display:flex;align-items:center;justify-content:center;gap:1rem;margin-bottom:1.5rem">
            <div style="width:40px;height:1px;background:#0B132B;opacity:.2"></div>
            <span style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:#8B90A0;font-weight:600">Ready to Start</span>
            <div style="width:40px;height:1px;background:#0B132B;opacity:.2"></div>
        </div>
        <h2 class="svc-brand-serif" style="font-size:clamp(2.5rem,5vw,4.5rem);color:#0B132B;font-weight:400;line-height:1;letter-spacing:-0.02em;margin-bottom:1.5rem">
            Let's build<br>something <em>iconic.</em>
        </h2>
        <p style="font-size:.88rem;color:#5E6472;margin-bottom:2.5rem;line-height:1.9;font-weight:300;">Our team is ready when you are.</p>
        <a href="{{ route('inquiries.create') }}"
           style="display:inline-block;padding:1.1rem 3.5rem;background:#0B132B;color:#fff;font-size:.72rem;letter-spacing:.2em;text-transform:uppercase;font-weight:600;text-decoration:none;transition:background .3s"
           onmouseover="this.style.background='#6C63FF'" onmouseout="this.style.background='#0B132B'">
            Submit Enquiry
        </a>
    </div>
</section>

@endsection
