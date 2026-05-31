@extends('layouts.app')
@section('title', $service->title . ' — AYKA Originals')
@section('description', \Illuminate\Support\Str::limit(strip_tags($service->description), 150))

@section('content')

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/split-type"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    gsap.registerPlugin(ScrollTrigger);

    // Hero title char reveal
    const title = new SplitType('.svc-det-title', { types: 'chars' });
    gsap.from(title.chars, { opacity: 0, y: 50, rotationX: -50, stagger: 0.03, duration: 1.1, ease: 'power4.out', delay: 0.2 });
    gsap.from('.svc-det-sub', { opacity: 0, y: 20, duration: 1, ease: 'power3.out', delay: 0.8 });
    gsap.from('.svc-det-tag', { scale: 0.8, opacity: 0, duration: 0.8, ease: 'back.out(1.7)', delay: 1 });

    // Content fade in
    gsap.from('.svc-det-content', {
        scrollTrigger: { trigger: '.svc-det-content', start: 'top 85%' },
        opacity: 0, y: 40, duration: 1.2, ease: 'power3.out'
    });

    // Other services
    gsap.utils.toArray('.other-svc-card').forEach((card, i) => {
        gsap.from(card, {
            scrollTrigger: { trigger: card, start: 'top 90%' },
            opacity: 0, y: 40, duration: 0.8, ease: 'expo.out', delay: i * 0.1
        });
    });
});
</script>
@endpush

<style>
.svc-brand-serif { font-family: 'Cormorant Garamond', serif; }

/* Content formatting for the wysiwyg / seed content */
.svc-det-content h2, .svc-det-content h3 { font-family: 'Cormorant Garamond', serif; color: #fff; margin-bottom: 1.5rem; margin-top: 3rem; font-weight: 400; }
.svc-det-content h2 { font-size: 2.5rem; }
.svc-det-content h3 { font-size: 2rem; }
.svc-det-content p { font-size: 1.05rem; line-height: 2; color: rgba(255,255,255,0.7); margin-bottom: 1.5rem; font-weight: 300; }
.svc-det-content ul, .svc-det-content ol { color: rgba(255,255,255,0.7); margin-bottom: 1.5rem; font-weight: 300; line-height: 2; padding-left: 1.5rem; }
.svc-det-content li { margin-bottom: 0.5rem; }

/* More services cards */
.other-svc-card { display: block; border-left: 1px solid rgba(255,255,255,0.1); padding: 2rem; background: rgba(255,255,255,0.02); transition: all 0.3s }
.other-svc-card:hover { background: rgba(108,99,255,0.08); border-color: rgba(108,99,255,0.5); }
</style>

{{-- ═══ HERO BANNER ═══ --}}
<section style="position:relative;min-height:80vh;background:#0B132B;display:flex;align-items:center;padding:8rem 1.5rem 4rem;overflow:hidden">
    {{-- Banner Image --}}
    @if($service->banner_image)
    <div style="position:absolute;inset:0;background-image:url('{{ $service->banner_image }}');background-size:cover;background-position:center;opacity:0.35;mix-blend-mode:luminosity;"></div>
    @else
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 50% 50%,rgba(108,99,255,.15) 0%,transparent 70%);pointer-events:none"></div>
    @endif
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom, #0B132B 0%, rgba(11,19,43,0.7) 40%, rgba(11,19,43,0.95) 100%);"></div>

    <div style="position:relative;z-index:2;max-width:1100px;margin:0 auto;width:100%;padding-top:4rem">
        <div class="svc-det-tag" style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);padding:.4rem 1rem;border-radius:999px;margin-bottom:2rem;backdrop-filter:blur(8px)">
            <span style="width:6px;height:6px;border-radius:50%;background:#6C63FF;display:inline-block"></span>
            <span style="font-size:.65rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.9)">{{ $service->tag ?? 'Service' }}</span>
        </div>
        
        <h1 class="svc-det-title svc-brand-serif" style="font-size:clamp(3.5rem,7vw,6.5rem);color:#fff;line-height:0.95;font-weight:400;letter-spacing:-0.02em;margin-bottom:2rem">
            {{ $service->title }}
        </h1>
        
        <p class="svc-det-sub" style="font-size:clamp(1rem,2vw,1.2rem);color:rgba(255,255,255,0.65);max-width:600px;line-height:1.8;font-weight:300;border-left:2px solid #6C63FF;padding-left:1.5rem">
            {{ $service->description }}
        </p>
    </div>
</section>

{{-- ═══ MAIN CONTENT ═══ --}}
<section style="background:#0B132B;padding:4rem 1.5rem 8rem">
    <div style="max-width:1100px;margin:0 auto;display:grid;grid-template-columns:1fr;gap:4rem">
        <div class="svc-det-content" style="max-width:800px">
            {!! $service->content !!}

            <div style="margin-top:4rem;padding-top:3rem;border-top:1px solid rgba(255,255,255,0.1)">
                <a href="{{ route('inquiries.create') }}" 
                   style="display:inline-flex;align-items:center;gap:.75rem;padding:1.1rem 2.5rem;background:#fff;color:#0B132B;font-size:.75rem;letter-spacing:.2em;text-transform:uppercase;font-weight:600;text-decoration:none;transition:all .3s"
                   onmouseover="this.style.background='#6C63FF';this.style.color='#fff'" onmouseout="this.style.background='#fff';this.style.color='#0B132B'">
                    Engage Our Services <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══ MORE SERVICES ═══ --}}
@if($otherServices->count() > 0)
<section style="background:#060B15;padding:8rem 1.5rem;border-top:1px solid rgba(255,255,255,0.05)">
    <div style="max-width:1440px;margin:0 auto">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:4rem">
            <h2 class="svc-brand-serif" style="font-size:2.5rem;color:#fff;font-weight:400">Explore More</h2>
            <a href="{{ route('services.index') }}" style="font-size:.65rem;letter-spacing:.2em;text-transform:uppercase;color:#8B90A0;text-decoration:none;border-bottom:1px solid rgba(255,255,255,0.1);padding-bottom:2px">View All Services</a>
        </div>
        
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:2rem">
            @foreach($otherServices as $other)
            <a href="{{ route('services.show', $other->slug) }}" class="other-svc-card" style="text-decoration:none">
                <span style="font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;color:#6C63FF;font-weight:600;display:block;margin-bottom:1rem">{{ $other->tag ?? 'Service' }}</span>
                <h3 class="svc-brand-serif" style="font-size:1.8rem;color:#fff;font-weight:400;margin-bottom:1rem;line-height:1.1">{{ $other->title }}</h3>
                <p style="font-size:.85rem;color:rgba(255,255,255,0.5);line-height:1.7;font-weight:300">{{ \Illuminate\Support\Str::limit($other->description, 90) }}</p>
                <div style="margin-top:2rem;font-size:.7rem;letter-spacing:.15em;text-transform:uppercase;color:#fff;display:flex;align-items:center;gap:.5rem">
                    View Details <svg style="width:12px;height:12px;opacity:.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
