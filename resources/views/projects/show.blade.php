@extends('layouts.app')
@section('title', $project->brand . ' — ' . $project->service_type)
@section('content')
<div style="padding-top:5rem">
  @if($project->hasMedia('gallery'))
  <div style="height:65vh;overflow:hidden;position:relative">
    <img src="{{ $project->getFirstMediaUrl('gallery','large') }}" alt="{{ $project->brand }}" style="width:100%;height:100%;object-fit:cover" loading="eager">
    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(11,19,43,0.6),transparent)"></div>
    <div style="position:absolute;bottom:0;left:0;right:0;padding:3rem" class="px-6 lg:px-16">
      <div style="max-width:1280px;margin:0 auto">
        <p class="section-tag" style="color:rgba(255,255,255,0.6);margin-bottom:0.75rem">{{ $project->service_type }} · {{ $project->year }}</p>
        <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,6vw,5rem);color:#fff;font-weight:400">{{ $project->brand }}</h1>
      </div>
    </div>
  </div>
  @else
  <div style="padding-top:5rem;padding-bottom:3rem;background:#F8F8FA" class="px-6 lg:px-16">
    <div style="max-width:1280px;margin:0 auto">
      <p class="section-tag" style="margin-bottom:0.75rem">{{ $project->service_type }} · {{ $project->year }}</p>
      <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,6vw,5rem);color:#0B132B;font-weight:400">{{ $project->brand }}</h1>
    </div>
  </div>
  @endif
  <div style="padding:5rem 1.5rem" class="px-6 lg:px-16">
    <div style="max-width:1280px;margin:0 auto">
      <div style="display:grid;grid-template-columns:1fr;gap:4rem;margin-bottom:4rem" class="lg:grid-cols-3">
        <div class="lg:col-span-2">@if($project->description)<p style="font-size:1rem;color:#5E6472;line-height:2">{{ $project->description }}</p>@endif</div>
        <div style="display:flex;flex-direction:column;gap:1.5rem">
          @foreach([['Brand',$project->brand],['Service',$project->service_type],['Year',$project->year]] as [$l,$v])
          <div class="stat-row"><span class="stat-label">{{ $l }}</span><span class="stat-value">{{ $v }}</span></div>
          @endforeach
        </div>
      </div>
      @if($project->getMedia('gallery')->count() > 1)
      <div style="columns:1;gap:1rem" class="sm:columns-2 lg:columns-3" style="column-gap:1rem">
        @foreach($project->getMedia('gallery') as $i => $img)
        @if($i > 0)
        <div style="break-inside:avoid;margin-bottom:1rem">
          <img src="{{ $img->getUrl('large') }}" alt="{{ $project->brand }}" style="width:100%;display:block" loading="lazy">
        </div>
        @endif
        @endforeach
      </div>
      @endif
      <div style="margin-top:4rem;padding-top:3rem;border-top:1px solid #E2E4EA">
        <a href="{{ route('projects.index') }}" style="display:inline-flex;align-items:center;gap:0.5rem;font-size:0.65rem;letter-spacing:0.2em;text-transform:uppercase;color:#5E6472" onmouseover="this.style.color='#0B132B'" onmouseout="this.style.color='#5E6472'">
          <svg style="width:0.75rem;height:0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
          All Projects
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
