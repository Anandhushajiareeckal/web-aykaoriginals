@extends('layouts.app')
@section('title', \App\Models\SiteSetting::get('site_name','AYKA Originals'))
@section('description','AYKA Originals — Premier Talent Management Agency')

@section('content')

{{-- ══════════ HERO VIDEO BANNER ══════════ --}}
<section style="position:relative;height:100vh;min-height:600px;overflow:hidden;display:flex;align-items:center;justify-content:center">

  {{-- Video Background --}}
  @if(isset($hero) && $hero?->video_url)
  <video autoplay muted loop playsinline
    style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0">
    <source src="{{ $hero->video_url }}" type="video/mp4">
  </video>
  @else
  {{-- Fallback: animated gradient --}}
  <div style="position:absolute;inset:0;background:linear-gradient(135deg,#0B132B 0%,#1C2951 50%,#0B132B 100%);z-index:0">
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 30% 50%,rgba(108,99,255,.15) 0%,transparent 60%)"></div>
    <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 70% 80%,rgba(6,182,212,.1) 0%,transparent 50%)"></div>
  </div>
  @endif

  {{-- Dark overlay --}}
  <div style="position:absolute;inset:0;background:rgba(11,19,43,.65);z-index:1"></div>

  {{-- Animated particles dots --}}
  <div style="position:absolute;inset:0;z-index:1;overflow:hidden">
    @for($i=0;$i<12;$i++)
    <div style="position:absolute;width:{{ rand(2,4) }}px;height:{{ rand(2,4) }}px;background:rgba(255,255,255,.{{ rand(1,3) }});border-radius:50%;top:{{ rand(5,90) }}%;left:{{ rand(5,90) }}%;animation:float{{ $i }} {{ rand(6,12) }}s ease-in-out infinite {{ rand(0,5) }}s alternate"></div>
    @endfor
  </div>

  {{-- Content --}}
  <div style="position:relative;z-index:2;text-align:center;padding:0 1.5rem;max-width:900px;margin:0 auto">

    {{-- Tag --}}
    <div style="display:inline-flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);padding:.4rem 1rem;border-radius:999px;margin-bottom:2rem;backdrop-filter:blur(8px)">
      <span style="width:6px;height:6px;border-radius:50%;background:#6C63FF;display:inline-block;animation:pulse 2s infinite"></span>
      <span style="font-size:.65rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.7)">
        {{ $hero?->subheading ?? 'AYKA ORIGINALS — Talent Management' }}
      </span>
    </div>

    {{-- Heading --}}
    <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,7vw,6rem);color:#fff;line-height:1.05;font-weight:400;margin-bottom:1.5rem;letter-spacing:-.01em">
      {!! nl2br(e($hero?->heading ?? 'WHERE TALENT\nMEETS VISION')) !!}
    </h1>

    {{-- Description --}}
    <p style="font-size:clamp(.85rem,2vw,1rem);color:rgba(255,255,255,.65);line-height:1.9;max-width:560px;margin:0 auto 2.5rem">
      {{ $hero?->body ?? 'We represent extraordinary models and creative talents for the world\'s most discerning luxury fashion, editorial, and commercial brands.' }}
    </p>

    {{-- CTA Buttons --}}
    <div style="display:flex;align-items:center;justify-content:center;gap:1rem;flex-wrap:wrap">
      <a href="{{ $hero?->btn1_url ?? route('talent.index') }}"
         style="display:inline-flex;align-items:center;gap:.5rem;padding:.875rem 2.25rem;background:#fff;color:#0B132B;font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;font-weight:600;transition:all .3s"
         onmouseover="this.style.background='#6C63FF';this.style.color='#fff';this.style.borderColor='#6C63FF'"
         onmouseout="this.style.background='#fff';this.style.color='#0B132B'">
        <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        {{ $hero?->btn1_label ?? 'Discover Talent' }}
      </a>
      <a href="{{ $hero?->btn2_url ?? route('projects.index') }}"
         style="display:inline-flex;align-items:center;gap:.5rem;padding:.875rem 2.25rem;background:transparent;color:#fff;font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;font-weight:500;border:1px solid rgba(255,255,255,.4);transition:all .3s"
         onmouseover="this.style.background='rgba(255,255,255,.1)';this.style.borderColor='rgba(255,255,255,.7)'"
         onmouseout="this.style.background='transparent';this.style.borderColor='rgba(255,255,255,.4)'">
        <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        {{ $hero?->btn2_label ?? 'Our Work' }}
      </a>
    </div>
  </div>

  {{-- Scroll indicator --}}
  <div style="position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);z-index:2;display:flex;flex-direction:column;align-items:center;gap:.5rem;opacity:.5">
    <span style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:#fff">Scroll</span>
    <div style="width:1px;height:40px;background:rgba(255,255,255,.4);animation:scrollLine 1.5s ease-in-out infinite"></div>
  </div>
</section>

<style>
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.4}}
@keyframes scrollLine{0%{height:0;opacity:1}100%{height:40px;opacity:0}}
@keyframes fadeUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
</style>

{{-- ══════════ STATS BAR ══════════ --}}
<section style="background:#0B132B;padding:2rem">
  <div style="max-width:1280px;margin:0 auto;display:flex;flex-wrap:wrap;justify-content:center;gap:0;text-align:center">
    @foreach([
      [\App\Models\SiteSetting::get('stats_count_1', $talentCount.'+'), \App\Models\SiteSetting::get('stats_label_1', 'Talents Represented')],
      [\App\Models\SiteSetting::get('stats_count_2', $projectCount.'+'), \App\Models\SiteSetting::get('stats_label_2', 'Campaigns Produced')],
      [\App\Models\SiteSetting::get('stats_count_3', '12+'), \App\Models\SiteSetting::get('stats_label_3', 'Countries')],
      [\App\Models\SiteSetting::get('stats_count_4', '2024'), \App\Models\SiteSetting::get('stats_label_4', 'Est.')]
    ] as $s)
    @if($s[0] && $s[1])
    <div style="padding:1.5rem 2.5rem;flex:1;min-width:200px;border-right:1px solid rgba(255,255,255,.07)">
      <p style="font-family:'Cormorant Garamond',serif;font-size:2.5rem;color:#fff;font-weight:400;line-height:1">{{ $s[0] }}</p>
      <p style="font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;color:rgba(255,255,255,.35);margin-top:.35rem">{{ $s[1] }}</p>
    </div>
    @endif
    @endforeach
  </div>
</section>

{{-- ══════════ CLIENT LOGOS ══════════ --}}
@if(isset($clients) && $clients->count())
<section style="padding:5rem 2rem;border-bottom:1px solid #E2E4EA;overflow:hidden">
  <div style="max-width:1280px;margin:0 auto">
    <div style="text-align:center;margin-bottom:3rem" data-animate>
      <p style="font-size:.6rem;letter-spacing:.35em;text-transform:uppercase;color:#8B90A0;margin-bottom:.5rem">
        {{ $clientsSection?->subheading ?? 'Our Clients' }}
      </p>
      <h2 style="font-family:'Cormorant Garamond',serif;font-size:2rem;color:#0B132B;font-weight:400">
        {{ $clientsSection?->heading ?? 'Trusted By Leading Brands' }}
      </h2>
    </div>

    {{-- Scrolling logo strip --}}
    <div style="position:relative;overflow:hidden" x-data>
      <div class="logo-track" style="display:flex;gap:4rem;align-items:center;animation:logoScroll 20s linear infinite;width:max-content">
        @foreach(array_merge($clients->all(), $clients->all()) as $client)
        <div style="flex-shrink:0;display:flex;align-items:center;justify-content:center;min-width:120px">
          @if($client->hasMedia('logo'))
            <img src="{{ $client->getFirstMediaUrl('logo','thumb') }}" alt="{{ $client->name }}"
                 style="height:32px;object-fit:contain;filter:grayscale(1);opacity:.5;transition:all .3s"
                 onmouseover="this.style.filter='grayscale(0)';this.style.opacity='1'"
                 onmouseout="this.style.filter='grayscale(1)';this.style.opacity='.5'">
          @else
            <span style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:600;letter-spacing:.15em;color:#8B90A0;white-space:nowrap;transition:color .3s"
                  onmouseover="this.style.color='#0B132B'" onmouseout="this.style.color='#8B90A0'">
              {{ strtoupper($client->name) }}
            </span>
          @endif
        </div>
        @endforeach
      </div>
      <div style="position:absolute;left:0;top:0;bottom:0;width:6rem;background:linear-gradient(to right,#fff,transparent);z-index:1;pointer-events:none"></div>
      <div style="position:absolute;right:0;top:0;bottom:0;width:6rem;background:linear-gradient(to left,#fff,transparent);z-index:1;pointer-events:none"></div>
    </div>
  </div>
</section>
<style>
@keyframes logoScroll{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}
.logo-track:hover{animation-play-state:paused}
</style>
@endif

{{-- ══════════ FEATURED TALENT ══════════ --}}
@if(isset($talents) && $talents->count())
<section style="padding:6rem 2rem" class="px-4 lg:px-16">
  <div style="max-width:1280px;margin:0 auto">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:3.5rem">
      <div data-animate>
        <p style="font-size:.6rem;letter-spacing:.35em;text-transform:uppercase;color:#5E6472;margin-bottom:.75rem">Featured Faces</p>
        <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,5vw,4rem);color:#0B132B;font-weight:400;line-height:1">Our <em>Talent</em></h2>
      </div>
      <a href="{{ route('talent.index') }}" style="display:inline-flex;align-items:center;gap:.5rem;font-size:.65rem;letter-spacing:.2em;text-transform:uppercase;color:#0B132B;border-bottom:1px solid #0B132B;padding-bottom:.2rem;transition:all .3s" onmouseover="this.style.color='#5E6472';this.style.borderColor='#5E6472'" onmouseout="this.style.color='#0B132B';this.style.borderColor='#0B132B'">
        View All Talent
        <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>
    <div style="display:flex;gap:1.5rem;overflow-x:auto;scroll-snap-type:x mandatory;padding-bottom:1.5rem;scrollbar-width:thin">
      @foreach($talents as $i => $talent)
      <a href="{{ route('talent.show',$talent->slug) }}"
         style="display:block;position:relative;overflow:hidden;cursor:pointer;flex:0 0 calc(70vw);max-width:320px;scroll-snap-align:start"
         class="talent-hover-card md:flex-[0_0_calc(35vw)] xl:flex-[0_0_300px]">
        <div style="aspect-ratio:2/3;overflow:hidden;background:#F4F5FA;position:relative">
          @if($talent->hasMedia('profile'))
            <img src="{{ $talent->getFirstMediaUrl('profile','medium') }}" alt="{{ $talent->name }}"
                 style="width:100%;height:100%;object-fit:cover;object-position:top;transition:transform .7s cubic-bezier(.25,.1,.25,1)"
                 class="talent-img" loading="lazy">
          @else
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#{{ ['0B132B','1C2951','243464','5E6472'][$i%4] }},#{{ ['1C2951','243464','5E6472','8B90A0'][$i%4] }});display:flex;align-items:center;justify-content:center">
              <span style="font-family:'Cormorant Garamond',serif;font-size:4rem;color:rgba(255,255,255,.3);font-weight:400">{{ substr($talent->name,0,1) }}</span>
            </div>
          @endif
          <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(11,19,43,.8) 0%,transparent 50%);opacity:0;transition:opacity .4s" class="talent-overlay"></div>
          <div style="position:absolute;bottom:0;left:0;right:0;padding:1.25rem;transform:translateY(10px);opacity:0;transition:all .4s" class="talent-info">
            <p style="color:#fff;font-family:'Cormorant Garamond',serif;font-size:1.1rem">{{ $talent->name }}</p>
            <p style="color:rgba(255,255,255,.6);font-size:.65rem;letter-spacing:.1em;text-transform:uppercase;margin-top:.2rem">{{ $talent->category }}</p>
          </div>
        </div>
        <div style="padding:.75rem 0">
          <p style="font-family:'Cormorant Garamond',serif;font-size:1rem;color:#0B132B">{{ $talent->name }}</p>
          <p style="font-size:.65rem;letter-spacing:.1em;text-transform:uppercase;color:#8B90A0;margin-top:.2rem">{{ $talent->location }}</p>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>

<style>
.talent-hover-card:hover .talent-img { transform: scale(1.06); }
.talent-hover-card:hover .talent-overlay { opacity: 1 !important; }
.talent-hover-card:hover .talent-info { opacity: 1 !important; transform: translateY(0) !important; }
</style>
@endif

{{-- ══════════ ABOUT SECTION WITH IMAGE ══════════ --}}
<section style="padding:6rem 2rem;background:#F4F5FA">
  <div style="max-width:1280px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center" class="grid-cols-1 lg:grid-cols-2">
    <div data-animate>
      <p style="font-size:.6rem;letter-spacing:.35em;text-transform:uppercase;color:#5E6472;margin-bottom:1rem">{{ $aboutSection?->subheading ?? 'About Us' }}</p>
      <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2rem,4vw,3rem);color:#0B132B;font-weight:400;line-height:1.2;margin-bottom:1.75rem">
        {{ $aboutSection?->heading ?? 'Premier Talent Management Since 2024' }}
      </h2>
      <p style="font-size:.9rem;color:#5E6472;line-height:2;margin-bottom:2rem">
        {{ $aboutSection?->body ?? 'AYKA Originals is a boutique talent management agency representing exceptional models and creatives.' }}
      </p>
      <div style="display:flex;gap:1rem;flex-wrap:wrap">
        @if($aboutSection?->btn1_label)
        <a href="{{ $aboutSection->btn1_url }}"
           style="display:inline-flex;align-items:center;gap:.5rem;padding:.75rem 2rem;background:#0B132B;color:#fff;font-size:.65rem;letter-spacing:.2em;text-transform:uppercase;transition:all .3s"
           onmouseover="this.style.background='#1C2951'" onmouseout="this.style.background='#0B132B'">
          {{ $aboutSection->btn1_label }}
        </a>
        @endif
      </div>
    </div>
    <div style="position:relative" data-animate>
      {{-- Main image --}}
      <div style="aspect-ratio:4/5;overflow:hidden;background:#E2E4EA">
        @if(isset($featuredTalent) && $featuredTalent?->hasMedia('profile'))
          <img src="{{ $featuredTalent->getFirstMediaUrl('profile','large') }}" alt="Featured Talent"
               style="width:100%;height:100%;object-fit:cover;object-position:top" loading="lazy">
        @else
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#0B132B,#1C2951);display:flex;align-items:center;justify-content:center">
            <span style="font-family:'Cormorant Garamond',serif;font-size:6rem;color:rgba(255,255,255,.15)">AO</span>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>

{{-- ══════════ SERVICES ══════════ --}}
@if(isset($services) && $services->count())
<section style="padding:6rem 2rem;background:#0B132B">
  <div style="max-width:1280px;margin:0 auto">
    <div style="text-align:center;margin-bottom:4rem" data-animate>
      <p style="font-size:.6rem;letter-spacing:.35em;text-transform:uppercase;color:#5E6472;margin-bottom:.75rem">{{ $servicesSection?->subheading ?? 'What We Offer' }}</p>
      <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,5vw,4rem);color:#fff;font-weight:400">{{ $servicesSection?->heading ?? 'Production Excellence' }}</h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:1.5rem">
      @foreach($services as $i => $service)
      <div style="padding:2rem;border:1px solid rgba(255,255,255,.07);transition:all .3s;cursor:pointer"
           onmouseover="this.style.background='rgba(255,255,255,.04)';this.style.borderColor='rgba(255,255,255,.15)'"
           onmouseout="this.style.background='transparent';this.style.borderColor='rgba(255,255,255,.07)'"
           data-animate>
        <div style="width:48px;height:48px;border-radius:12px;background:rgba(108,99,255,.15);display:flex;align-items:center;justify-content:center;margin-bottom:1.5rem">
          <span style="font-size:1.4rem">{{ ['⭐','📸','✏️','💼'][$i%4] }}</span>
        </div>
        <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.3rem;color:#fff;font-weight:400;margin-bottom:.75rem">{{ $service->title }}</h3>
        <p style="font-size:.8rem;color:rgba(255,255,255,.45);line-height:1.9">{{ $service->description }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ══════════ WORK SHOWCASE ══════════ --}}
@if(isset($featuredProject) || (isset($talents) && $talents->count()))
<section style="padding:6rem 2rem">
  <div style="max-width:1280px;margin:0 auto">
    <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:3rem">
      <div data-animate>
        <p style="font-size:.6rem;letter-spacing:.35em;text-transform:uppercase;color:#5E6472;margin-bottom:.75rem">Our Work</p>
        <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,5vw,4rem);color:#0B132B;font-weight:400;line-height:1">Recent <em>Projects</em></h2>
      </div>
      <a href="{{ route('projects.index') }}" style="display:inline-flex;align-items:center;gap:.5rem;font-size:.65rem;letter-spacing:.2em;text-transform:uppercase;color:#0B132B;border-bottom:1px solid #0B132B;padding-bottom:.2rem">
        View All Work
        <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
      </a>
    </div>
    @php $projects = \App\Models\Project::active()->with('media')->latest()->limit(3)->get(); @endphp
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1.5rem">
      @forelse($projects as $proj)
      <a href="{{ route('projects.show',$proj->slug) }}" style="display:block;overflow:hidden;position:relative" class="talent-hover-card">
        <div style="aspect-ratio:16/10;overflow:hidden;background:#F4F5FA">
          @if($proj->hasMedia('gallery'))
            <img src="{{ $proj->getFirstMediaUrl('gallery','medium') }}" alt="{{ $proj->brand }}"
                 class="talent-img" style="width:100%;height:100%;object-fit:cover;transition:transform .7s ease" loading="lazy">
          @else
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#0B132B,#1C2951);display:flex;align-items:center;justify-content:center">
              <span style="font-family:'Cormorant Garamond',serif;font-size:3rem;color:rgba(255,255,255,.2)">{{ substr($proj->brand,0,1) }}</span>
            </div>
          @endif
        </div>
        <div style="padding:1.25rem 0">
          <p style="font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;color:#5E6472;margin-bottom:.4rem">{{ $proj->service_type }} · {{ $proj->year }}</p>
          <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;color:#0B132B">{{ $proj->brand }}</h3>
        </div>
      </a>
      @empty
      <div style="grid-column:1/-1;padding:4rem;text-align:center;background:#F4F5FA">
        <p style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;color:#8B90A0">Projects coming soon</p>
      </div>
      @endforelse
    </div>
  </div>
</section>
@endif

{{-- ══════════ BLOG POSTS ══════════ --}}
@if(isset($latestPosts) && $latestPosts->count())
<section style="padding:6rem 2rem;background:#F4F5FA">
  <div style="max-width:1280px;margin:0 auto">
    <div style="text-align:center;margin-bottom:3.5rem" data-animate>
      <p style="font-size:.6rem;letter-spacing:.35em;text-transform:uppercase;color:#5E6472;margin-bottom:.75rem">Journal</p>
      <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2rem,4vw,3rem);color:#0B132B;font-weight:400">Latest <em>Insights</em></h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:2rem">
      @foreach($latestPosts as $post)
      <a href="{{ route('blog.show',$post->slug) }}" style="display:block">
        <div style="aspect-ratio:16/9;overflow:hidden;background:#E2E4EA;margin-bottom:1.25rem">
          @if($post->hasMedia('cover'))
            <img src="{{ $post->getFirstMediaUrl('cover','medium') }}" alt="{{ $post->title }}"
                 style="width:100%;height:100%;object-fit:cover;transition:transform .7s ease"
                 onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" loading="lazy">
          @else
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#0B132B,#1C2951)"></div>
          @endif
        </div>
        @if($post->category)<p style="font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;color:#5E6472;margin-bottom:.5rem">{{ $post->category }}</p>@endif
        <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.25rem;color:#0B132B;line-height:1.3;margin-bottom:.5rem">{{ $post->title }}</h3>
        <p style="font-size:.7rem;color:#8B90A0">{{ $post->published_at?->format('M d, Y') }}</p>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ══════════ CTA BANNER ══════════ --}}
<section style="padding:7rem 2rem;background:#0B132B;position:relative;overflow:hidden;text-align:center">
  <div style="position:absolute;inset:0;background:radial-gradient(ellipse at 50% 50%,rgba(108,99,255,.12) 0%,transparent 70%)"></div>
  <div style="position:relative;z-index:1;max-width:700px;margin:0 auto" data-animate>
    <p style="font-size:.6rem;letter-spacing:.35em;text-transform:uppercase;color:#5E6472;margin-bottom:1.5rem">{{ $ctaSection?->subheading ?? 'Work With Us' }}</p>
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,5vw,4rem);color:#fff;font-weight:400;line-height:1.15;margin-bottom:2rem">
      {{ $ctaSection?->heading ?? "Ready to Create\nSomething Exceptional?" }}
    </h2>
    <p style="font-size:.9rem;color:rgba(255,255,255,.5);margin-bottom:2.5rem;line-height:1.9">
      {{ $ctaSection?->body ?? 'Submit a booking inquiry and our team will respond within 24 hours.' }}
    </p>
    <a href="{{ $ctaSection?->btn1_url ?? route('inquiries.create') }}"
       style="display:inline-flex;align-items:center;gap:.5rem;padding:1rem 2.5rem;background:#fff;color:#0B132B;font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;font-weight:600;transition:all .3s"
       onmouseover="this.style.background='#6C63FF';this.style.color='#fff'"
       onmouseout="this.style.background='#fff';this.style.color='#0B132B'">
      {{ $ctaSection?->btn1_label ?? 'Contact Us' }}
      <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    </a>
  </div>
</section>

@endsection
