<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','AYKA Originals') — Talent Management</title>
  <meta name="description" content="@yield('description','AYKA Originals — Premier Talent Management Agency')">
  @yield('meta')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @stack('styles')
</head>
<body class="antialiased" style="font-family:'Montserrat',sans-serif;background:#fff;color:#0B132B">

{{-- ══════════ NAVBAR ══════════ --}}
<header
  x-data="{ open:false, scrolled:false, reqOpen:false, init(){ window.addEventListener('scroll',()=>{ this.scrolled=window.scrollY>40 }); }}"
  :class="scrolled ? 'nav-scrolled' : 'nav-hidden-top'"
  class="site-nav"
  style="position:fixed;top:0;left:0;right:0;z-index:100;transition:all .4s ease">

  <style>
    .site-nav { padding:0 2rem; background:transparent; }
    .site-nav.nav-hidden-top { opacity: 0; pointer-events: none; transform: translateY(-10px); }
    .site-nav.nav-scrolled { opacity: 1; pointer-events: auto; transform: translateY(0); background:rgba(11,19,43,.97); backdrop-filter:blur(12px); box-shadow:0 2px 30px rgba(0,0,0,.2); }
    .nav-inner { max-width:1280px; margin:0 auto; height:72px; display:flex; align-items:center; justify-content:space-between; }
    .nav-logo { display:flex; flex-direction:column; line-height:1; cursor:pointer; }
    .nav-logo .l1 { font-family:'Cormorant Garamond',serif; font-size:1.4rem; font-weight:600; letter-spacing:.25em; color:#fff; }
    .nav-logo .l2 { font-size:.45rem; letter-spacing:.5em; color:rgba(255,255,255,.45); text-transform:uppercase; margin-top:-1px; }
    .nav-links { display:flex; align-items:center; gap:2rem; }
    .nav-item { position:relative; }
    .nav-a { font-size:.7rem; letter-spacing:.2em; text-transform:uppercase; color:rgba(255,255,255,.75); transition:color .3s; cursor:pointer; display:flex; align-items:center; gap:.35rem; white-space:nowrap; }
    .nav-a:hover, .nav-a.active { color:#fff; }
    .nav-dropdown { position:absolute; top:calc(100% + .75rem); left:50%; transform:translateX(-50%); background:#0B132B; border:1px solid rgba(255,255,255,.08); min-width:180px; opacity:0; visibility:hidden; transition:all .25s; }
    .nav-item:hover .nav-dropdown { opacity:1; visibility:visible; transform:translateX(-50%) translateY(0); }
    .nav-dropdown a { display:block; padding:.75rem 1.25rem; font-size:.72rem; letter-spacing:.15em; text-transform:uppercase; color:rgba(255,255,255,.6); transition:all .2s; border-bottom:1px solid rgba(255,255,255,.05); }
    .nav-dropdown a:last-child { border-bottom:none; }
    .nav-dropdown a:hover { background:rgba(255,255,255,.06); color:#fff; padding-left:1.5rem; }
    .nav-cta { font-size:.65rem; letter-spacing:.2em; text-transform:uppercase; padding:.55rem 1.5rem; border:1px solid rgba(255,255,255,.4); color:#fff; transition:all .3s; }
    .nav-cta:hover { background:#fff; color:#0B132B; border-color:#fff; }
    .hamburger { display:none; flex-direction:column; gap:5px; background:none; border:none; cursor:pointer; padding:.5rem; }
    .hamburger span { display:block; width:22px; height:1.5px; background:#fff; transition:all .3s; }
    .mobile-menu { display:none; position:fixed; inset:0; background:#0B132B; z-index:200; padding:2rem; flex-direction:column; overflow-y:auto; }
    .mobile-menu.open { display:flex; }
    .mobile-menu-close { align-self:flex-end; background:none; border:none; color:#fff; font-size:1.5rem; cursor:pointer; margin-bottom:2rem; }
    .mobile-nav-a { display:block; font-size:.9rem; letter-spacing:.2em; text-transform:uppercase; color:rgba(255,255,255,.7); padding:1rem 0; border-bottom:1px solid rgba(255,255,255,.07); transition:color .2s; }
    .mobile-nav-a:hover { color:#fff; }
    .mobile-sub { padding:.5rem 0 .5rem 1rem; }
    .mobile-sub a { display:block; font-size:.75rem; letter-spacing:.15em; text-transform:uppercase; color:rgba(255,255,255,.5); padding:.5rem 0; }
    @media(max-width:1024px) { .nav-links { display:none; } .hamburger { display:flex; } }
    @media(max-width:640px) { .site-nav { padding:0 1rem; } }
  </style>

  <div class="nav-inner">
    <a href="{{ route('home') }}" class="nav-logo">
      <span class="l1">AYKA</span>
      <span class="l2">ORIGINALS</span>
    </a>

    <nav class="nav-links">
      <div class="nav-item">
        <a href="{{ route('home') }}" class="nav-a {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
      </div>
      <div class="nav-item">
        <a href="{{ route('about') }}" class="nav-a {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
      </div>
      <div class="nav-item">
        <a href="{{ route('services.index') }}" class="nav-a {{ request()->routeIs('services.index') ? 'active' : '' }}">Services</a>
      </div>
      <div class="nav-item">
        <span class="nav-a {{ request()->routeIs('talent.*','projects.*') ? 'active' : '' }}">
          Requirement
          <svg style="width:.6rem;height:.6rem;opacity:.6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
        </span>
        <div class="nav-dropdown">
          <a href="{{ route('talent.index') }}">Talent</a>
          <a href="{{ route('projects.index') }}">Production</a>
        </div>
      </div>
      <div class="nav-item">
        <a href="{{ route('blog.index') }}" class="nav-a {{ request()->routeIs('blog.*') ? 'active' : '' }}">Journal</a>
      </div>
    </nav>

    <a href="{{ route('inquiries.create') }}" class="nav-cta hidden lg:block">Contact Us</a>

    <button class="hamburger lg:hidden" @click="open=true">
      <span :class="open?'rotate-45 translate-y-2':''"></span>
      <span :class="open?'opacity-0':''"></span>
      <span :class="open?'-rotate-45 -translate-y-2':''"></span>
    </button>
  </div>

  {{-- Mobile Menu --}}
  <div class="mobile-menu" :class="open?'open':''" x-show="open" x-cloak>
    <button class="mobile-menu-close" @click="open=false">✕</button>
    <a href="{{ route('home') }}" class="mobile-nav-a" @click="open=false">Home</a>
    <a href="{{ route('about') }}" class="mobile-nav-a" @click="open=false">About</a>
    <a href="{{ route('services.index') }}" class="mobile-nav-a" @click="open=false">Services</a>
    <div>
      <span class="mobile-nav-a" style="display:block">Requirement</span>
      <div class="mobile-sub">
        <a href="{{ route('talent.index') }}" @click="open=false">Talent</a>
        <a href="{{ route('projects.index') }}" @click="open=false">Production</a>
      </div>
    </div>
    <a href="{{ route('blog.index') }}" class="mobile-nav-a" @click="open=false">Journal</a>
    <a href="{{ route('gallery.index') }}" class="mobile-nav-a" @click="open=false">Gallery</a>
    <a href="{{ route('inquiries.create') }}" class="mobile-nav-a" style="color:#fff;margin-top:1rem;padding:1rem 1.5rem;border:1px solid rgba(255,255,255,.3);text-align:center" @click="open=false">Contact Us</a>
  </div>
</header>

<main>@yield('content')</main>

{{-- FOOTER --}}
<footer class="site-footer" style="background:linear-gradient(to bottom, #0B132B, #060A1A);color:#fff;padding:6rem 2rem 2rem; position:relative; overflow:hidden;">
  <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right, transparent, rgba(255,255,255,0.2), transparent);"></div>
  <div style="position:absolute;bottom:0;left:50%;transform:translate(-50%,50%);width:60vw;height:60vw;background:radial-gradient(circle, rgba(108,99,255,0.03) 0%, transparent 70%);border-radius:50%;pointer-events:none;"></div>
  <div style="max-width:1280px;margin:0 auto;position:relative;z-index:1;">
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:4rem;margin-bottom:4rem">
      <div>
        <div style="font-family:'Cormorant Garamond',serif;font-size:2.2rem;letter-spacing:.25em;margin-bottom:.15rem; background: linear-gradient(to right, #fff, rgba(255,255,255,0.6)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">AYKA</div>
        <div style="font-size:.55rem;letter-spacing:.6em;color:rgba(255,255,255,.4);margin-bottom:1.75rem">ORIGINALS</div>
        <p style="font-size:.85rem;color:rgba(255,255,255,.5);line-height:1.9;max-width:320px">
          {{ \App\Models\SiteSetting::get('footer_text','A premier talent management agency representing extraordinary talent globally. Discover the difference of true partnership.') }}
        </p>
      </div>
      <div>
        <p style="font-size:.65rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.3);margin-bottom:1.5rem">Navigate</p>
        <div style="display:flex;flex-direction:column;gap:1rem">
          @foreach([['Home',route('home')],['About',route('about')],['Services',route('services.index')],['Talent',route('talent.index')],['Work',route('projects.index')],['Journal',route('blog.index')],['Gallery',route('gallery.index')]] as $l)
          <a href="{{ $l[1] }}" style="font-size:.85rem;color:rgba(255,255,255,.45);transition:all .3s; display:inline-block; width:fit-content;" onmouseover="this.style.color='#fff'; this.style.transform='translateX(5px)';" onmouseout="this.style.color='rgba(255,255,255,.45)'; this.style.transform='translateX(0)';">{{ $l[0] }}</a>
          @endforeach
        </div>
      </div>
      <div>
        <p style="font-size:.65rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.3);margin-bottom:1.5rem">Legal</p>
        <div style="display:flex;flex-direction:column;gap:1rem">
          <a href="{{ route('page.show','privacy-policy') }}" style="font-size:.85rem;color:rgba(255,255,255,.45);transition:all .3s; display:inline-block; width:fit-content;" onmouseover="this.style.color='#fff'; this.style.transform='translateX(5px)';" onmouseout="this.style.color='rgba(255,255,255,.45)'; this.style.transform='translateX(0)';">Privacy Policy</a>
          <a href="{{ route('page.show','terms-conditions') }}" style="font-size:.85rem;color:rgba(255,255,255,.45);transition:all .3s; display:inline-block; width:fit-content;" onmouseover="this.style.color='#fff'; this.style.transform='translateX(5px)';" onmouseout="this.style.color='rgba(255,255,255,.45)'; this.style.transform='translateX(0)';">Terms &amp; Conditions</a>
        </div>
      </div>
      <div>
        <p style="font-size:.65rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.3);margin-bottom:1.5rem">Contact</p>
        <div style="display:flex;flex-direction:column;gap:1rem">
          <a href="mailto:{{ \App\Models\SiteSetting::get('site_email','hello@aykaoriginals.com') }}" style="font-size:.85rem;color:rgba(255,255,255,.6);transition:color .3s;" onmouseover="this.style.color='#fff';" onmouseout="this.style.color='rgba(255,255,255,.6)';">{{ \App\Models\SiteSetting::get('site_email','hello@aykaoriginals.com') }}</a>
          <p style="font-size:.85rem;color:rgba(255,255,255,.45)">{{ \App\Models\SiteSetting::get('site_address','New York, NY') }}</p>
        </div>
        <a href="{{ route('inquiries.create') }}" style="display:inline-flex;align-items:center;justify-content:center;margin-top:2rem;padding:.8rem 2rem;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,.15);font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;color:#fff;border-radius:30px;transition:all .3s" onmouseover="this.style.background='#fff';this.style.color='#0B132B'" onmouseout="this.style.background='rgba(255,255,255,0.05)';this.style.color='#fff'">Inquire Now</a>
      </div>
    </div>
    <div style="border-top:1px solid rgba(255,255,255,.06);padding-top:2rem;display:flex;flex-wrap:wrap;gap:1.5rem;align-items:center;justify-content:space-between">
      <p style="font-size:.75rem;color:rgba(255,255,255,.3)">&copy; {{ date('Y') }} AYKA Originals. All rights reserved.</p>
      <div style="display:flex;gap:1.5rem;align-items:center;">
        <p style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.2)">EST. 2024</p>
        <div style="width:4px;height:4px;background:rgba(255,255,255,0.2);border-radius:50%;"></div>
        <p style="font-size:.6rem;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.2)">TALENT MANAGEMENT</p>
      </div>
    </div>
  </div>
</footer>

@stack('scripts')
</body>
</html>
