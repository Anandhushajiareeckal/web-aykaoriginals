<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','My Portal') — AYKA Model Portal</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css'])
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    *{box-sizing:border-box;margin:0;padding:0}
    :root{--navy:#0B132B;--navy2:#1C2951;--navy3:#243464;--slate:#5E6472;--slate2:#8B90A0;--white:#fff;--off:#F4F5FA;--border:#E4E6F0;--accent:#6C63FF;--accent2:#8B80FF;--green:#22C55E;--amber:#F59E0B;--red:#EF4444;--cyan:#06B6D4;--gold:#C9A96E;--sidebar-w:260px}
    body{font-family:'Inter',sans-serif;background:var(--off);color:var(--navy);overflow-x:hidden}
    a{text-decoration:none;color:inherit}
    /* ── Sidebar ── */
    .sidebar{position:fixed;top:0;left:0;bottom:0;width:var(--sidebar-w);background:linear-gradient(180deg,var(--navy) 0%,#0d1830 100%);z-index:100;display:flex;flex-direction:column;transition:transform .3s ease;overflow:hidden}
    .sidebar-logo{padding:1.5rem 1.25rem;border-bottom:1px solid rgba(255,255,255,.07);display:flex;align-items:center;gap:.75rem;flex-shrink:0}
    .sidebar-logo-icon{width:38px;height:38px;background:linear-gradient(135deg,var(--gold),#e8c07a);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .sidebar-logo-icon span{font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:600;color:#fff;letter-spacing:.05em}
    .sidebar-logo-text .name{font-family:'Cormorant Garamond',serif;font-size:1rem;font-weight:600;color:#fff;letter-spacing:.2em}
    .sidebar-logo-text .sub{font-size:.5rem;letter-spacing:.4em;color:var(--gold);text-transform:uppercase;margin-top:1px;opacity:.7}
    .sidebar-section{padding:.75rem 1rem .25rem;font-size:.55rem;letter-spacing:.2em;text-transform:uppercase;color:rgba(255,255,255,.25);font-weight:600}
    .sidebar-link{display:flex;align-items:center;gap:.75rem;padding:.65rem 1rem;margin:.1rem .75rem;border-radius:8px;font-size:.8rem;font-weight:500;color:rgba(255,255,255,.55);transition:all .2s;cursor:pointer;position:relative}
    .sidebar-link:hover{background:rgba(255,255,255,.07);color:rgba(255,255,255,.9)}
    .sidebar-link.active{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;box-shadow:0 4px 15px rgba(108,99,255,.4)}
    .sidebar-link .icon{width:1rem;height:1rem;flex-shrink:0;opacity:.8}
    .sidebar-link.active .icon{opacity:1}
    .sidebar-scroll{flex:1;overflow-y:auto;padding-bottom:1rem}
    .sidebar-scroll::-webkit-scrollbar{width:3px}
    .sidebar-scroll::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1);border-radius:999px}
    .sidebar-footer{padding:1rem;border-top:1px solid rgba(255,255,255,.07);flex-shrink:0}
    .sidebar-user{display:flex;align-items:center;gap:.75rem;padding:.5rem .75rem;border-radius:8px;cursor:pointer;transition:background .2s}
    .sidebar-user:hover{background:rgba(255,255,255,.07)}
    .sidebar-avatar{width:34px;height:34px;border-radius:8px;background:linear-gradient(135deg,var(--gold),#e8c07a);display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;color:#fff;flex-shrink:0}
    .sidebar-user-info .uname{font-size:.78rem;font-weight:600;color:#fff}
    .sidebar-user-info .urole{font-size:.62rem;color:var(--gold);opacity:.8}
    /* ── Topbar ── */
    .topbar{position:fixed;top:0;left:var(--sidebar-w);right:0;height:64px;background:var(--white);border-bottom:1px solid var(--border);z-index:90;display:flex;align-items:center;padding:0 1.5rem;gap:1rem}
    .topbar-toggle{display:none;background:none;border:none;cursor:pointer;color:var(--slate);padding:.25rem}
    .topbar-breadcrumb{flex:1}
    .topbar-breadcrumb .page-title{font-size:1rem;font-weight:600;color:var(--navy);display:block;line-height:1.2}
    .topbar-breadcrumb .path{font-size:.7rem;color:var(--slate2)}
    .topbar-actions{display:flex;align-items:center;gap:.5rem}
    .topbar-btn{width:36px;height:36px;border-radius:8px;border:1px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--slate);transition:all .2s}
    .topbar-btn:hover{background:var(--off);border-color:var(--navy);color:var(--navy)}
    .topbar-divider{width:1px;height:24px;background:var(--border);margin:0 .25rem}
    .topbar-profile{display:flex;align-items:center;gap:.5rem;padding:.35rem .6rem .35rem .35rem;border-radius:8px;border:1px solid var(--border);cursor:pointer;transition:all .2s}
    .topbar-profile:hover{background:var(--off)}
    .topbar-profile-avatar{width:28px;height:28px;border-radius:6px;background:linear-gradient(135deg,var(--gold),#e8c07a);display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:700;color:#fff}
    .topbar-profile-name{font-size:.75rem;font-weight:600;color:var(--navy)}
    .topbar-view-site{display:inline-flex;align-items:center;gap:.4rem;font-size:.7rem;font-weight:500;color:var(--slate);border:1px solid var(--border);border-radius:8px;padding:.35rem .75rem;transition:all .2s}
    .topbar-view-site:hover{border-color:var(--accent);color:var(--accent)}
    /* ── Main wrap ── */
    .main-wrap{margin-left:var(--sidebar-w);padding-top:64px;min-height:100vh}
    .main-content{padding:1.75rem 1.5rem}
    /* ── Reuse admin design system ── */
    .stat-card{background:#fff;border-radius:12px;padding:1.25rem;border:1px solid var(--border);transition:transform .2s,box-shadow .2s;position:relative;overflow:hidden}
    .stat-card:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(11,19,43,.1)}
    .stat-card-icon{width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem}
    .stat-card-value{font-size:1.75rem;font-weight:700;color:var(--navy);line-height:1;margin-bottom:.25rem;font-family:'Cormorant Garamond',serif}
    .stat-card-label{font-size:.72rem;color:var(--slate2);font-weight:500;letter-spacing:.05em}
    .panel{background:#fff;border-radius:12px;border:1px solid var(--border);overflow:hidden}
    .panel-header{padding:1rem 1.25rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
    .panel-title{font-size:.85rem;font-weight:600;color:var(--navy)}
    .panel-body{padding:1.25rem}
    .data-table{width:100%;border-collapse:collapse;font-size:.8rem}
    .data-table thead th{padding:.75rem 1rem;text-align:left;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:var(--slate2);font-weight:600;background:var(--off);border-bottom:1px solid var(--border)}
    .data-table tbody tr{border-bottom:1px solid var(--border);transition:background .15s}
    .data-table tbody tr:hover{background:var(--off)}
    .data-table tbody tr:last-child{border-bottom:none}
    .data-table tbody td{padding:.8rem 1rem;color:var(--navy);vertical-align:middle}
    .btn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;border-radius:8px;font-size:.75rem;font-weight:600;cursor:pointer;transition:all .2s;border:none}
    .btn-primary{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;box-shadow:0 4px 12px rgba(108,99,255,.35)}
    .btn-primary:hover{box-shadow:0 6px 20px rgba(108,99,255,.5);transform:translateY(-1px)}
    .btn-gold{background:linear-gradient(135deg,var(--gold),#e8c07a);color:#fff;box-shadow:0 4px 12px rgba(201,169,110,.35)}
    .btn-gold:hover{box-shadow:0 6px 20px rgba(201,169,110,.5);transform:translateY(-1px)}
    .btn-outline{background:transparent;color:var(--slate);border:1px solid var(--border)}
    .btn-outline:hover{border-color:var(--accent);color:var(--accent)}
    .btn-danger{background:#fee2e2;color:var(--red);border:none}.btn-danger:hover{background:var(--red);color:#fff}
    .btn-sm{padding:.35rem .75rem;font-size:.7rem}
    .btn-icon{width:32px;height:32px;padding:0;justify-content:center;border-radius:8px}
    .form-group{margin-bottom:1.25rem}
    .form-label{display:block;font-size:.7rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:var(--slate);margin-bottom:.5rem}
    .form-control{width:100%;padding:.625rem .875rem;border:1.5px solid var(--border);border-radius:8px;font-size:.85rem;color:var(--navy);background:#fff;transition:border-color .2s,box-shadow .2s;font-family:'Inter',sans-serif}
    .form-control:focus{outline:none;border-color:var(--accent);box-shadow:0 0 0 3px rgba(108,99,255,.12)}
    .form-control::placeholder{color:var(--slate2)}
    textarea.form-control{resize:vertical;min-height:100px}
    select.form-control{cursor:pointer}
    .badge{display:inline-flex;align-items:center;gap:.3rem;padding:.2rem .6rem;border-radius:999px;font-size:.65rem;font-weight:600}
    .badge-green{background:#dcfce7;color:#16a34a}.badge-red{background:#fee2e2;color:#dc2626}
    .badge-amber{background:#fef3c7;color:#d97706}.badge-blue{background:#dbeafe;color:#2563eb}
    .badge-purple{background:#ede9fe;color:#7c3aed}.badge-slate{background:#f1f5f9;color:#475569}
    .badge-gold{background:#fef3c7;color:#92400e}
    .divider{height:1px;background:var(--border);margin:1rem 0}
    .sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(11,19,43,.5);z-index:99}
    /* Completeness bar */
    .completeness-bar{height:8px;background:var(--border);border-radius:999px;overflow:hidden;margin-top:.5rem}
    .completeness-fill{height:100%;border-radius:999px;transition:width 1s ease;background:linear-gradient(90deg,var(--accent),var(--cyan))}
    /* ── Bottom Nav (Mobile) ── */
    .bottom-nav{display:none;position:fixed;bottom:0;left:0;right:0;z-index:300;background:linear-gradient(to top,#060c1a,#0b132b);border-top:1px solid rgba(255,255,255,.1);align-items:stretch;justify-content:space-around;padding-bottom:env(safe-area-inset-bottom,0px)}
    .bottom-nav-item{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:3px;padding:.6rem .25rem;color:rgba(255,255,255,.35);text-decoration:none;-webkit-tap-highlight-color:transparent;touch-action:manipulation;flex:1;min-height:60px;transition:color .15s}
    .bottom-nav-item.active{color:var(--gold)}
    .bottom-nav-item svg{width:1.35rem;height:1.35rem;transition:transform .15s}
    .bottom-nav-item.active svg{transform:scale(1.15)}
    .bottom-nav-item span{font-size:.38rem;letter-spacing:.05em;text-transform:uppercase;font-weight:700;white-space:nowrap;text-overflow:ellipsis;overflow:hidden;max-width:100%}
    /* Mobile layout */
    @media(max-width:900px){
      .sidebar{position:fixed;top:0;left:0;bottom:0;transform:translateX(-100%);z-index:250;transition:transform .3s cubic-bezier(.4,0,.2,1)}
      .sidebar.mobile-open{transform:translateX(0);box-shadow:20px 0 60px rgba(0,0,0,.6)}
      .sidebar-overlay{display:block;opacity:0;pointer-events:none;transition:opacity .3s}
      .sidebar-overlay.active{opacity:1;pointer-events:all}
      .main-wrap{margin-left:0 !important;padding-top:56px !important;padding-bottom:64px !important}
      .topbar{left:0 !important;right:0 !important;height:56px !important;padding:0 1rem !important}
      .topbar-toggle{display:none !important}
      .topbar-divider,.topbar-view-site{display:none !important}
      .topbar-breadcrumb .path{display:none}
      .bottom-nav{display:flex !important}
      .main-content{padding:.875rem !important}
    }
    @media(max-width:480px){
      .main-content{padding:.625rem !important}
      .panel-body{padding:.875rem}
      .panel-header{padding:.75rem .875rem}
      .stat-card{padding:1rem}
      .btn{font-size:.7rem;padding:.45rem .875rem}
    }
    *{-webkit-tap-highlight-color:transparent}
    html{scroll-behavior:smooth;-webkit-text-size-adjust:100%;overflow-x:hidden}
  </style>
</head>
<body x-data="{ mobileNav: false }">
<div class="sidebar-overlay" :class="{ 'active': mobileNav }" @click="mobileNav=false"></div>

<aside class="sidebar" :class="{ 'mobile-open': mobileNav }">
  <div class="sidebar-logo">
    <div class="sidebar-logo-icon"><span>AO</span></div>
    <div class="sidebar-logo-text">
      <div class="name">MODEL</div>
      <div class="sub">Portal</div>
    </div>
  </div>
  <div class="sidebar-scroll">
    <div class="sidebar-section">Overview</div>
    <a href="{{ route('model.dashboard') }}" class="sidebar-link {{ request()->routeIs('model.dashboard') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
      Dashboard
    </a>
    <a href="{{ route('model.inquiries.index') }}" class="sidebar-link {{ request()->routeIs('model.inquiries.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      Inquiries
      @if(auth()->user()->talent)
        @php $inqCount = \App\Models\Inquiry::where('talent_id', auth()->user()->talent->id)->count(); @endphp
        @if($inqCount > 0)
          <span style="margin-left:auto;background:var(--accent);color:#fff;font-size:.65rem;font-weight:700;padding:.15rem .4rem;border-radius:99px">{{ $inqCount }}</span>
        @endif
      @endif
    </a>
    <div class="sidebar-section">My Profile</div>
    <a href="{{ route('model.profile.edit') }}" class="sidebar-link {{ request()->routeIs('model.profile.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
      Edit Profile
    </a>
    <div class="sidebar-section">Content</div>
    <a href="{{ route('model.comp-card.index') }}" class="sidebar-link {{ request()->routeIs('model.comp-card.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0M9 14h6m-6 4h6"/></svg>
      Comp Card
    </a>
    <a href="{{ route('model.portfolio.index') }}" class="sidebar-link {{ request()->routeIs('model.portfolio.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
      Portfolio
    </a>
    <a href="{{ route('model.works.index') }}" class="sidebar-link {{ request()->routeIs('model.works.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"/></svg>
      Highlight Works
    </a>
    <div class="sidebar-section">Account</div>
    <a href="{{ route('model.settings.index') }}" class="sidebar-link {{ request()->routeIs('model.settings.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      Settings
    </a>
    @auth
    @if(auth()->user()->talent)
    <a href="{{ route('model.show', auth()->user()->talent->slug) }}" target="_blank" class="sidebar-link">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
      View Public Profile
    </a>
    @endif
    @endauth
  </div>
  <div class="sidebar-footer">
    <form method="POST" action="{{ route('model.logout') }}" style="display:contents">
      @csrf
      <button type="submit" style="width:100%;background:none;border:none;cursor:pointer;text-align:left">
        <div class="sidebar-user">
          <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'M', 0, 2)) }}</div>
          <div class="sidebar-user-info">
            <div class="uname">{{ auth()->user()->name ?? 'Model' }}</div>
            <div class="urole">Model Portal</div>
          </div>
          <svg style="width:.875rem;height:.875rem;color:rgba(255,255,255,.3);margin-left:auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
        </div>
      </button>
    </form>
  </div>
</aside>

<header class="topbar">
  <div class="topbar-breadcrumb">
    <span class="page-title">@yield('title','Dashboard')</span>
    <span class="path">AYKA Model Portal</span>
  </div>
  <div class="topbar-actions">
    <a href="{{ route('home') }}" target="_blank" class="topbar-view-site">
      <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
      <span>View Site</span>
    </a>
    <div class="topbar-divider"></div>
    <div class="topbar-profile">
      <div class="topbar-profile-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'M', 0, 2)) }}</div>
      <span class="topbar-profile-name">{{ auth()->user()->name ?? 'Model' }}</span>
    </div>
  </div>
</header>

<div class="main-wrap">
  <div class="main-content">
    @if(session('success'))
    <div style="display:flex;align-items:center;gap:.75rem;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:.875rem 1.125rem;margin-bottom:1.5rem;font-size:.82rem;color:#15803d">
      <svg style="width:1rem;height:1rem;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div style="display:flex;align-items:center;gap:.75rem;background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:.875rem 1.125rem;margin-bottom:1.5rem;font-size:.82rem;color:#dc2626">
      <svg style="width:1rem;height:1rem;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      {{ session('error') }}
    </div>
    @endif
    @if(session('info'))
    <div style="display:flex;align-items:center;gap:.75rem;background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:.875rem 1.125rem;margin-bottom:1.5rem;font-size:.82rem;color:#2563eb">
      <svg style="width:1rem;height:1rem;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      {{ session('info') }}
    </div>
    @endif
    
    @if($errors->any())
    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:1rem 1.25rem;margin-bottom:1.5rem">
      <div style="display:flex;align-items:center;gap:.75rem;font-size:.82rem;color:#dc2626;font-weight:600;margin-bottom:.5rem">
        <svg style="width:1rem;height:1rem;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Please fix the following errors:
      </div>
      <ul style="margin:0;padding-left:2rem;color:#dc2626;font-size:.78rem">
        @foreach($errors->all() as $err)
        <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    
    @yield('content')
  </div>
</div>

@stack('scripts')

{{-- ── Mobile Bottom Navigation ── --}}
<nav class="bottom-nav" id="bottom-nav">
  <a href="{{ route('model.dashboard') }}" class="bottom-nav-item {{ request()->routeIs('model.dashboard') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    <span>Home</span>
  </a>
  <a href="{{ route('model.portfolio.index') }}" class="bottom-nav-item {{ request()->routeIs('model.portfolio.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
    <span>Portfolio</span>
  </a>
  <a href="{{ route('model.works.index') }}" class="bottom-nav-item {{ request()->routeIs('model.works.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"/></svg>
    <span>Works</span>
  </a>
  <a href="{{ route('model.inquiries.index') }}" class="bottom-nav-item {{ request()->routeIs('model.inquiries.*') ? 'active' : '' }}" style="position:relative">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
    <span>Inquiries</span>
    @if(auth()->user()->talent)
      @php $inqCount = \App\Models\Inquiry::where('talent_id', auth()->user()->talent->id)->count(); @endphp
      @if($inqCount > 0)
        <span style="position:absolute;top:5px;right:5px;width:16px;height:16px;background:var(--red);color:#fff;font-size:.55rem;font-weight:700;border-radius:50%;display:flex;align-items:center;justify-content:center">{{ $inqCount > 9 ? '9+' : $inqCount }}</span>
      @endif
    @endif
  </a>
  <a href="{{ route('model.profile.edit') }}" class="bottom-nav-item {{ request()->routeIs('model.profile.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
    <span>Profile</span>
  </a>
  <a href="{{ route('model.settings.index') }}" class="bottom-nav-item {{ request()->routeIs('model.settings.*') ? 'active' : '' }}">
    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
    <span>More</span>
  </a>
</nav>

</body>
</html>
