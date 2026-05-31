@extends('layouts.app')
@section('title', 'Our Talent — AYKA Originals')
@section('description', 'Discover the extraordinary roster of talent represented by AYKA Originals.')

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/split-type"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    gsap.registerPlugin(ScrollTrigger);

    // Hero reveal
    const split = new SplitType('.tal-hero-title', { types: 'chars' });
    gsap.from(split.chars, { opacity: 0, y: 60, rotationX: -50, stagger: 0.025, duration: 1, ease: 'power4.out', delay: 0.2 });
    gsap.from('.tal-hero-sub', { opacity: 0, y: 20, duration: 1, ease: 'power3.out', delay: 0.9 });

    // Stats counter
    document.querySelectorAll('.stat-num').forEach(el => {
        const target = +el.dataset.val;
        gsap.from({ val: 0 }, {
            scrollTrigger: { trigger: el, start: 'top 90%' },
            val: target, duration: 2, ease: 'power2.out',
            onUpdate: function() { el.textContent = Math.floor(this.targets()[0].val); }
        });
    });

    // Talent cards stagger
    gsap.utils.toArray('.tal-card').forEach((card, i) => {
        gsap.from(card, {
            scrollTrigger: { trigger: card, start: 'top 92%' },
            opacity: 0, y: 50, duration: 0.8, ease: 'expo.out', delay: (i % 3) * 0.08
        });
    });

    // Category breakdown donut chart
    const ctx = document.getElementById('catChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Models', 'Actors', 'Influencers', 'Musicians'],
                datasets: [{ data: [38, 27, 22, 13], backgroundColor: ['#6C63FF','rgba(108,99,255,.55)','rgba(108,99,255,.3)','rgba(108,99,255,.15)'], borderWidth: 0, hoverOffset: 6 }]
            },
            options: { cutout: '78%', plugins: { legend: { display: false } }, animation: { duration: 1800, easing: 'easeInOutQuart' } }
        });
    }

    // Tilt on cards
    document.querySelectorAll('.tal-card').forEach(card => {
        card.addEventListener('mousemove', e => {
            const r = card.getBoundingClientRect();
            const x = ((e.clientX - r.left) / r.width - 0.5) * 12;
            const y = ((e.clientY - r.top)  / r.height - 0.5) * -12;
            card.style.transform = `perspective(800px) rotateY(${x}deg) rotateX(${y}deg) translateZ(10px)`;
        });
        card.addEventListener('mouseleave', () => { card.style.transform = ''; });
    });
});
</script>
@endpush

<style>
* { box-sizing: border-box; }
.tal-serif { font-family: 'Cormorant Garamond', serif; }

/* HERO */
.tal-hero { position: relative; min-height: 60vh; background: #0B132B; display: flex; align-items: center; overflow: hidden; padding: 7rem 1.5rem 4rem; }
.tal-hero-title { font-size: clamp(3rem,6vw,5.5rem); color: #fff; font-weight: 400; line-height: 0.92; letter-spacing: -0.02em; }
.tal-hero-sub { font-size: clamp(0.75rem,1.2vw,0.85rem); color: rgba(255,255,255,0.5); max-width: 480px; line-height: 1.8; font-weight: 300; margin-top: 1.5rem; }

/* STATS STRIP */
.tal-stat { border-left: 1px solid rgba(255,255,255,0.1); padding: 0 2rem; }
.tal-stat:first-child { border-left: none; padding-left: 0; }

/* FILTERS */
.fil-btn { font-size: .6rem; letter-spacing: .2em; text-transform: uppercase; padding: .45rem 1.2rem; border: 1px solid rgba(255,255,255,.15); color: rgba(255,255,255,.6); background: transparent; cursor: pointer; transition: all .3s; border-radius: 999px; }
.fil-btn.active, .fil-btn:hover { background: #fff; color: #0B132B; border-color: #fff; }

/* TALENT CARD */
.tal-card { background: #fff; border-radius: 20px; overflow: hidden; transition: transform .4s cubic-bezier(.23,1,.32,1), box-shadow .4s; will-change: transform; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.06); }
.tal-card:hover { box-shadow: 0 30px 80px rgba(0,0,0,.15); }
.tal-card-img { width: 100%; aspect-ratio: 4/5; object-fit: cover; display: block; }
.tal-card-img-placeholder { width: 100%; aspect-ratio: 4/5; background: linear-gradient(135deg, #1a2444 0%, #0B132B 100%); display: flex; align-items: center; justify-content: center; }
.tal-card-body { padding: 1.25rem; }
.tal-badge { display: inline-flex; align-items: center; gap: .4rem; font-size: .55rem; letter-spacing: .25em; text-transform: uppercase; color: #6C63FF; font-weight: 700; margin-bottom: .6rem; }
.tal-badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: #6C63FF; display: inline-block; }
.tal-name { font-size: 1.35rem; color: #0B132B; font-weight: 400; line-height: 1.1; margin-bottom: .35rem; }
.tal-loc { font-size: .7rem; color: #8B90A0; letter-spacing: .1em; }
.tal-meas { display: flex; gap: 1rem; margin-top: .9rem; padding-top: .9rem; border-top: 1px solid #F4F5FA; }
.tal-meas-item { text-align: center; }
.tal-meas-val { font-size: .8rem; font-weight: 600; color: #0B132B; display: block; }
.tal-meas-lbl { font-size: .55rem; letter-spacing: .12em; text-transform: uppercase; color: #B0B5C3; margin-top: 2px; display: block; }
.tal-view { display: flex; align-items: center; justify-content: space-between; margin-top: 1.1rem; text-decoration: none; }
.tal-view span { font-size: .6rem; letter-spacing: .2em; text-transform: uppercase; color: #6C63FF; }
.tal-view svg { width: 14px; height: 14px; color: #6C63FF; transition: transform .3s; }
.tal-card:hover .tal-view svg { transform: translateX(4px); }

/* Responsive grid */
.tal-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; }
@media (max-width: 1024px) { .tal-grid { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; } }
@media (max-width: 640px) { .tal-grid { grid-template-columns: 1fr; gap: 1.5rem; } .tal-stat { padding: 0 1rem; } .tal-hero { min-height: 50vh; } }
</style>

@section('content')

{{-- ═══ HERO ═══ --}}
<section class="tal-hero">
    {{-- Orbs --}}
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 20% 50%,rgba(108,99,255,.2) 0%,transparent 55%);pointer-events:none"></div>
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 80% 30%,rgba(6,182,212,.08) 0%,transparent 55%);pointer-events:none"></div>
    <div style="position:absolute;bottom:0;left:0;right:0;height:40%;background:linear-gradient(to top,#0B132B,transparent);pointer-events:none"></div>

    {{-- Background grid --}}
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,.02) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.02) 1px,transparent 1px);background-size:80px 80px;pointer-events:none"></div>

    <div style="position:relative;z-index:2;max-width:1440px;margin:0 auto;width:100%;display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center">
        <div>
            <div style="display:inline-flex;align-items:center;gap:.6rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);padding:.4rem 1.2rem;border-radius:999px;margin-bottom:2.5rem;backdrop-filter:blur(8px)">
                <span style="width:6px;height:6px;border-radius:50%;background:#6C63FF;display:inline-block;animation:pulse-dot 2s infinite"></span>
                <span style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.8)">Our Roster</span>
            </div>
            <h1 class="tal-hero-title tal-serif">{!! $sections['hero']->heading ?? 'The<br>Talent<br><em style="opacity:.65">Behind<br>the Work.</em>' !!}</h1>
            <p class="tal-hero-sub">{{ $sections['hero']->body ?? "Every brand needs a face. Every campaign, a presence. We represent extraordinary individuals who don't just follow culture — they define it." }}</p>

            <div style="margin-top:3rem;display:flex;gap:0;flex-wrap:wrap">
                @php
                $stats = [
                    [optional($sections->get('stat_1'))->heading ?? '6+', optional($sections->get('stat_1'))->subheading ?? 'Active Talent'],
                    [optional($sections->get('stat_2'))->heading ?? '120+', optional($sections->get('stat_2'))->subheading ?? 'Campaigns Delivered'],
                    [optional($sections->get('stat_3'))->heading ?? '40+', optional($sections->get('stat_3'))->subheading ?? 'Brand Partnerships'],
                    [optional($sections->get('stat_4'))->heading ?? '3+', optional($sections->get('stat_4'))->subheading ?? 'Countries Active'],
                ];
                @endphp
                @foreach($stats as $s)
                <div class="tal-stat">
                    <div class="tal-serif" style="font-size:2.8rem;color:#fff;line-height:1;font-weight:300;animation:fadeUp .8s ease both">{{ $s[0] }}</div>
                    <div style="font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-top:.4rem">{{ $s[1] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Right: Donut chart --}}
        <div style="display:flex;flex-direction:column;align-items:center;gap:1.5rem">
            <div style="position:relative;width:240px;height:240px">
                <canvas id="catChart" width="240" height="240"></canvas>
                <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center">
                    <span class="tal-serif" style="font-size:2.5rem;color:#fff;line-height:1;font-weight:300">{{ $talents->count() }}</span>
                    <span style="font-size:.55rem;letter-spacing:.2em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-top:.25rem">Talents</span>
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem 2rem">
                @foreach([['#6C63FF','Models'],['rgba(108,99,255,.55)','Actors'],['rgba(108,99,255,.3)','Influencers'],['rgba(108,99,255,.15)','Musicians']] as $item)
                <div style="display:flex;align-items:center;gap:.5rem">
                    <div style="width:8px;height:8px;border-radius:50%;background:{{ $item[0] }};flex-shrink:0"></div>
                    <span style="font-size:.65rem;color:rgba(255,255,255,.5);letter-spacing:.08em">{{ $item[1] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ═══ FILTERS + GRID ═══ --}}
<section style="background:#F4F5FA;padding:6rem 1.5rem 8rem">
    <div style="max-width:1440px;margin:0 auto">

        {{-- Section header --}}
        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:3rem">
            <div>
                <p style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:#8B90A0;margin-bottom:.5rem">Our Roster</p>
                <h2 class="tal-serif" style="font-size:clamp(2rem,4vw,3.5rem);color:#0B132B;font-weight:400;line-height:1.05">{!! $sections['roster']->heading ?? 'Meet the<br><em>Extraordinary.</em>' !!}</h2>
            </div>
            <div style="display:flex;gap:.5rem;flex-wrap:wrap">
                <button class="fil-btn active" onclick="filterTalent('all',this)">All</button>
                <button class="fil-btn" onclick="filterTalent('female',this)">Female</button>
                <button class="fil-btn" onclick="filterTalent('male',this)">Male</button>
            </div>
        </div>

        {{-- Grid --}}
        <div class="tal-grid" id="talent-grid">
            @forelse($talents as $t)
            @php $img = $t->getFirstMediaUrl('profile','medium') ?: $t->getFirstMediaUrl('profile') ?: null; @endphp
            <div class="tal-card" data-gender="{{ strtolower($t->gender ?? '') }}">
                @if($img)
                    <img src="{{ $img }}" alt="{{ $t->name }}" class="tal-card-img" loading="lazy">
                @else
                    <div class="tal-card-img-placeholder">
                        <svg width="48" height="48" fill="none" stroke="rgba(255,255,255,0.2)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                @endif
                <div class="tal-card-body">
                    <div class="tal-badge">{{ $t->category ?? 'Talent' }}</div>
                    <h3 class="tal-name tal-serif">{{ $t->name }}</h3>
                    <p class="tal-loc">{{ $t->location ?? 'Global' }}</p>
                    @if($t->height || $t->chest_bust || $t->waist)
                    <div class="tal-meas">
                        @if($t->height)<div class="tal-meas-item"><span class="tal-meas-val">{{ $t->height }}</span><span class="tal-meas-lbl">Height</span></div>@endif
                        @if($t->chest_bust)<div class="tal-meas-item"><span class="tal-meas-val">{{ $t->chest_bust }}</span><span class="tal-meas-lbl">Bust</span></div>@endif
                        @if($t->waist)<div class="tal-meas-item"><span class="tal-meas-val">{{ $t->waist }}</span><span class="tal-meas-lbl">Waist</span></div>@endif
                        @if($t->hips)<div class="tal-meas-item"><span class="tal-meas-val">{{ $t->hips }}</span><span class="tal-meas-lbl">Hips</span></div>@endif
                    </div>
                    @endif
                    <a href="{{ route('talent.show', $t->slug) }}" class="tal-view">
                        <span>View Profile</span>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:6rem 2rem">
                <p style="font-size:1rem;color:#8B90A0">No talent profiles found.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ═══ CTA ═══ --}}
<section style="background:#0B132B;padding:8rem 1.5rem;text-align:center;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 50% 50%,rgba(108,99,255,.12) 0%,transparent 70%);pointer-events:none"></div>
    <div style="position:relative;z-index:2;max-width:700px;margin:0 auto">
        <p style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:1.25rem">Join the Roster</p>
        <h2 class="tal-serif" style="font-size:clamp(2.5rem,5vw,4.5rem);color:#fff;font-weight:400;line-height:1.05;margin-bottom:1.5rem">Are you the next<br><em style="opacity:.7">AYKA talent?</em></h2>
        <p style="font-size:.9rem;color:rgba(255,255,255,.5);line-height:1.9;margin-bottom:3rem;font-weight:300">We are always looking for extraordinary individuals ready to elevate their careers to the global stage.</p>
        <a href="{{ route('inquiries.create') }}" style="display:inline-flex;align-items:center;gap:.75rem;padding:1.1rem 3rem;background:#fff;color:#0B132B;font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;font-weight:600;text-decoration:none;transition:all .3s" onmouseover="this.style.background='#6C63FF';this.style.color='#fff'" onmouseout="this.style.background='#fff';this.style.color='#0B132B'">
            Apply Now
            <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</section>

<style>
@keyframes pulse-dot { 0%,100%{ opacity:1; transform:scale(1) } 50%{ opacity:.5; transform:scale(1.5) } }
@keyframes fadeUp { from { opacity:0; transform:translateY(16px) } to { opacity:1; transform:translateY(0) } }
@media(max-width:900px){
    .tal-hero > div > div:first-child + div { display: none; }
    .tal-hero > div { grid-template-columns: 1fr; }
}
</style>

<script>
function filterTalent(gender, btn) {
    document.querySelectorAll('.fil-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.tal-card').forEach(card => {
        const g = card.dataset.gender || '';
        card.style.display = (gender === 'all' || g === gender) ? '' : 'none';
    });
}
</script>

@endsection
