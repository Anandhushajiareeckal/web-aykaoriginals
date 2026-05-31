<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','Dashboard') — AYKA Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css'])
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>
    *{box-sizing:border-box;margin:0;padding:0}
    :root{--navy:#0B132B;--navy2:#1C2951;--navy3:#243464;--slate:#5E6472;--slate2:#8B90A0;--white:#fff;--off:#F4F5FA;--border:#E4E6F0;--accent:#6C63FF;--accent2:#8B80FF;--green:#22C55E;--amber:#F59E0B;--red:#EF4444;--cyan:#06B6D4;--sidebar-w:260px}
    body{font-family:'Inter',sans-serif;background:var(--off);color:var(--navy);overflow-x:hidden}
    a{text-decoration:none;color:inherit}
    .sidebar{position:fixed;top:0;left:0;bottom:0;width:var(--sidebar-w);background:var(--navy);z-index:100;display:flex;flex-direction:column;transition:transform .3s ease;overflow:hidden}
    .sidebar-logo{padding:1.5rem 1.25rem;border-bottom:1px solid rgba(255,255,255,.07);display:flex;align-items:center;gap:.75rem;flex-shrink:0}
    .sidebar-logo-icon{width:38px;height:38px;background:linear-gradient(135deg,var(--accent),var(--cyan));border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .sidebar-logo-icon span{font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:600;color:#fff;letter-spacing:.05em}
    .sidebar-logo-text .name{font-family:'Cormorant Garamond',serif;font-size:1rem;font-weight:600;color:#fff;letter-spacing:.2em}
    .sidebar-logo-text .sub{font-size:.5rem;letter-spacing:.4em;color:var(--slate2);text-transform:uppercase;margin-top:1px}
    .sidebar-section{padding:.75rem 1rem .25rem;font-size:.55rem;letter-spacing:.2em;text-transform:uppercase;color:rgba(255,255,255,.25);font-weight:600}
    .sidebar-link{display:flex;align-items:center;gap:.75rem;padding:.65rem 1rem;margin:.1rem .75rem;border-radius:8px;font-size:.8rem;font-weight:500;color:rgba(255,255,255,.55);transition:all .2s;cursor:pointer;position:relative}
    .sidebar-link:hover{background:rgba(255,255,255,.07);color:rgba(255,255,255,.9)}
    .sidebar-link.active{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;box-shadow:0 4px 15px rgba(108,99,255,.4)}
    .sidebar-link .icon{width:1rem;height:1rem;flex-shrink:0;opacity:.8}
    .sidebar-link.active .icon{opacity:1}
    .sidebar-link .badge{margin-left:auto;background:var(--red);color:#fff;font-size:.55rem;font-weight:700;padding:.15rem .4rem;border-radius:999px;min-width:1.2rem;text-align:center}
    .sidebar-scroll{flex:1;overflow-y:auto;padding-bottom:1rem}
    .sidebar-scroll::-webkit-scrollbar{width:3px}
    .sidebar-scroll::-webkit-scrollbar-thumb{background:rgba(255,255,255,.1);border-radius:999px}
    .sidebar-footer{padding:1rem;border-top:1px solid rgba(255,255,255,.07);flex-shrink:0}
    .sidebar-user{display:flex;align-items:center;gap:.75rem;padding:.5rem .75rem;border-radius:8px;cursor:pointer;transition:background .2s}
    .sidebar-user:hover{background:rgba(255,255,255,.07)}
    .sidebar-avatar{width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,var(--accent),var(--cyan));display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700;color:#fff;flex-shrink:0}
    .sidebar-user-info .uname{font-size:.78rem;font-weight:600;color:#fff}
    .sidebar-user-info .urole{font-size:.65rem;color:var(--slate2)}
    .topbar{position:fixed;top:0;left:var(--sidebar-w);right:0;height:64px;background:var(--white);border-bottom:1px solid var(--border);z-index:90;display:flex;align-items:center;padding:0 1.5rem;gap:1rem}
    .topbar-toggle{display:none;background:none;border:none;cursor:pointer;color:var(--slate);padding:.25rem}
    .topbar-breadcrumb{flex:1}
    .topbar-breadcrumb .page-title{font-size:1rem;font-weight:600;color:var(--navy);display:block;line-height:1.2}
    .topbar-breadcrumb .path{font-size:.7rem;color:var(--slate2)}
    .topbar-actions{display:flex;align-items:center;gap:.5rem}
    .topbar-btn{width:36px;height:36px;border-radius:8px;border:1px solid var(--border);background:var(--white);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--slate);transition:all .2s;position:relative}
    .topbar-btn:hover{background:var(--off);border-color:var(--navy);color:var(--navy)}
    .topbar-btn .dot{position:absolute;top:6px;right:6px;width:7px;height:7px;border-radius:50%;background:var(--red);border:1.5px solid #fff}
    .topbar-divider{width:1px;height:24px;background:var(--border);margin:0 .25rem}
    .topbar-profile{display:flex;align-items:center;gap:.5rem;padding:.35rem .6rem .35rem .35rem;border-radius:8px;border:1px solid var(--border);cursor:pointer;transition:all .2s}
    .topbar-profile:hover{background:var(--off)}
    .topbar-profile-avatar{width:28px;height:28px;border-radius:6px;background:linear-gradient(135deg,var(--accent),var(--cyan));display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:700;color:#fff}
    .topbar-profile-name{font-size:.75rem;font-weight:600;color:var(--navy)}
    .main-wrap{margin-left:var(--sidebar-w);padding-top:64px;min-height:100vh}
    .main-content{padding:1.75rem 1.5rem}
    .stat-card{background:#fff;border-radius:12px;padding:1.25rem;border:1px solid var(--border);transition:transform .2s,box-shadow .2s;position:relative;overflow:hidden}
    .stat-card:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(11,19,43,.1)}
    .stat-card-icon{width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;margin-bottom:1rem}
    .stat-card-value{font-size:1.75rem;font-weight:700;color:var(--navy);line-height:1;margin-bottom:.25rem;font-family:'Cormorant Garamond',serif}
    .stat-card-label{font-size:.72rem;color:var(--slate2);font-weight:500;letter-spacing:.05em}
    .stat-card-change{display:flex;align-items:center;gap:.3rem;font-size:.7rem;font-weight:600;margin-top:.5rem}
    .stat-card-change.up{color:var(--green)}.stat-card-change.down{color:var(--red)}
    .stat-card-bg{position:absolute;right:-10px;bottom:-10px;opacity:.06;font-size:5rem}
    .data-table{width:100%;border-collapse:collapse;font-size:.8rem}
    .data-table thead th{padding:.75rem 1rem;text-align:left;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;color:var(--slate2);font-weight:600;background:var(--off);border-bottom:1px solid var(--border)}
    .data-table tbody tr{border-bottom:1px solid var(--border);transition:background .15s}
    .data-table tbody tr:hover{background:var(--off)}
    .data-table tbody tr:last-child{border-bottom:none}
    .data-table tbody td{padding:.8rem 1rem;color:var(--navy);vertical-align:middle}
    .badge{display:inline-flex;align-items:center;gap:.3rem;padding:.2rem .6rem;border-radius:999px;font-size:.65rem;font-weight:600}
    .badge-green{background:#dcfce7;color:#16a34a}.badge-red{background:#fee2e2;color:#dc2626}
    .badge-amber{background:#fef3c7;color:#d97706}.badge-blue{background:#dbeafe;color:#2563eb}
    .badge-purple{background:#ede9fe;color:#7c3aed}.badge-slate{background:#f1f5f9;color:#475569}
    .panel{background:#fff;border-radius:12px;border:1px solid var(--border);overflow:hidden}
    .panel-header{padding:1rem 1.25rem;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
    .panel-title{font-size:.85rem;font-weight:600;color:var(--navy)}
    .panel-body{padding:1.25rem}
    .btn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;border-radius:8px;font-size:.75rem;font-weight:600;cursor:pointer;transition:all .2s;border:none}
    .btn-primary{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;box-shadow:0 4px 12px rgba(108,99,255,.35)}
    .btn-primary:hover{box-shadow:0 6px 20px rgba(108,99,255,.5);transform:translateY(-1px)}
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
    .avatar{border-radius:8px;background:linear-gradient(135deg,var(--accent),var(--cyan));display:flex;align-items:center;justify-content:center;font-weight:700;color:#fff;flex-shrink:0}
    .tag{display:inline-block;padding:.15rem .5rem;border-radius:4px;font-size:.65rem;font-weight:600;background:var(--off);color:var(--slate)}
    .divider{height:1px;background:var(--border);margin:1rem 0}
    .sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(11,19,43,.5);z-index:99}
    @media(max-width:1024px){.sidebar{transform:translateX(-100%)}.sidebar.mobile-open{transform:translateX(0)}.sidebar-overlay.active{display:block}.main-wrap{margin-left:0}.topbar{left:0}.topbar-toggle{display:flex}}
    @media(max-width:640px){.main-content{padding:1rem}.topbar{padding:0 1rem}}
  </style>
</head>
<body x-data="{ mobileNav: false }">
<div class="sidebar-overlay" :class="{ 'active': mobileNav }" @click="mobileNav=false"></div>

<aside class="sidebar" :class="{ 'mobile-open': mobileNav }">
  <div class="sidebar-logo">
    <div class="sidebar-logo-icon"><span>AO</span></div>
    <div class="sidebar-logo-text">
      <div class="name">AYKA</div>
      <div class="sub">Originals Admin</div>
    </div>
  </div>
  <div class="sidebar-scroll">
    <div class="sidebar-section">Main</div>
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
      Dashboard
    </a>
    <a href="{{ route('admin.homepage.index') }}" class="sidebar-link {{ request()->routeIs('admin.homepage.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
      Homepage Builder
    </a>
    <a href="{{ route('admin.about.index') }}" class="sidebar-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
      About Builder
    </a>
    <a href="{{ route('admin.service-builder.index') }}" class="sidebar-link {{ request()->routeIs('admin.service-builder.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
      Service Builder
    </a>
    <div class="sidebar-section">Content</div>
    <a href="{{ route('admin.talent.index') }}" class="sidebar-link {{ request()->routeIs('admin.talent.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      Talent
      @php $pendingTalents = \App\Models\Talent::talents()->where('status','pending')->count(); @endphp
      @if($pendingTalents)<span class="badge" style="background:var(--amber)">{{ $pendingTalents }}</span>@endif
    </a>
    <a href="{{ route('admin.talent-builder.index') }}" class="sidebar-link {{ request()->routeIs('admin.talent-builder.*') ? 'active' : '' }}" style="padding-left:2.25rem;font-size:.78rem">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
      Page Builder
    </a>
    <a href="{{ route('admin.models.index') }}" class="sidebar-link {{ request()->routeIs('admin.models.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/></svg>
      Model Profiles
      @php $pendingModels = \App\Models\Talent::models()->where('status','pending')->count(); @endphp
      @if($pendingModels)<span class="badge">{{ $pendingModels }}</span>@endif
    </a>
    <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
      Work
    </a>
    <a href="{{ route('admin.work-builder.index') }}" class="sidebar-link {{ request()->routeIs('admin.work-builder.*') ? 'active' : '' }}" style="padding-left:2.25rem;font-size:.78rem">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:14px;height:14px"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
      Page Builder
    </a>
    <a href="{{ route('admin.blog.index') }}" class="sidebar-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
      Blog / Journal
    </a>
    <a href="{{ route('admin.gallery.index') }}" class="sidebar-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
      Gallery
    </a>
    <div class="sidebar-section">Management</div>
    <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      Services (Items)
    </a>
    <a href="{{ route('admin.pages.index') }}" class="sidebar-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
      Pages
    </a>
    <a href="{{ route('admin.inquiries.index') }}" class="sidebar-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      Inquiries
      @php $nc = \App\Models\Inquiry::where('status','new')->count(); @endphp
      @if($nc)<span class="badge">{{ $nc }}</span>@endif
    </a>
    <div class="sidebar-section">System</div>
    <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      Settings
    </a>
    <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
      <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
      View Site
    </a>
  </div>
  <div class="sidebar-footer">
    <form method="POST" action="{{ route('admin.logout') }}" style="display:contents">
      @csrf
      <button type="submit" style="width:100%;background:none;border:none;cursor:pointer;text-align:left">
        <div class="sidebar-user">
          <div class="sidebar-avatar">{{ strtoupper(substr(session('admin_name','A'),0,2)) }}</div>
          <div class="sidebar-user-info">
            <div class="uname">{{ session('admin_name','Admin') }}</div>
            <div class="urole">Administrator</div>
          </div>
          <svg style="width:.875rem;height:.875rem;color:rgba(255,255,255,.3);margin-left:auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
        </div>
      </button>
    </form>
  </div>
</aside>

<header class="topbar">
  <button class="topbar-toggle" @click="mobileNav=!mobileNav">
    <svg style="width:1.25rem;height:1.25rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
  </button>
  <div class="topbar-breadcrumb">
    <span class="page-title">@yield('title','Dashboard')</span>
    <span class="path">AYKA Admin / @yield('title','Dashboard')</span>
  </div>
  <div class="topbar-actions">
    <button class="topbar-btn">
      <svg style="width:.9rem;height:.9rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    </button>
    <button class="topbar-btn">
      <svg style="width:.9rem;height:.9rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
      @if(\App\Models\Inquiry::where('status','new')->count())<div class="dot"></div>@endif
    </button>
    <div class="topbar-divider"></div>
    <div class="topbar-profile">
      <div class="topbar-profile-avatar">{{ strtoupper(substr(session('admin_name','A'),0,2)) }}</div>
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
    @yield('content')
  </div>
</div>

@stack('scripts')
</body>
</html>
