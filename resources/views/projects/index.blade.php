@extends('layouts.app')
@section('title','Projects')
@section('description','AYKA Originals projects — campaigns, editorials, and lookbooks for luxury fashion brands.')
@section('content')
<div style="padding-top:7rem;padding-bottom:5rem" class="px-6 lg:px-16">
  <div style="max-width:1280px;margin:0 auto">
    <div style="margin-bottom:4rem" data-animate>
      <p class="section-tag" style="margin-bottom:0.75rem">Our Work</p>
      <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(3rem,6vw,5rem);color:#0B132B;font-weight:400;line-height:1">Projects &amp;<br><em>Case Studies</em></h1>
    </div>
    <div style="display:flex;flex-direction:column">
      @forelse($projects as $i => $project)
      <a href="{{ route('projects.show',$project->slug) }}" style="display:grid;grid-template-columns:1fr;gap:2rem;padding:3rem 0;border-top:1px solid #E2E4EA;text-decoration:none;transition:border-color 0.3s" class="lg:grid-cols-12 group" data-animate onmouseover="this.style.borderColor='#0B132B'" onmouseout="this.style.borderColor='#E2E4EA'">
        <div style="grid-column:span 1;padding-top:0.5rem" class="lg:col-span-1"><span style="font-size:0.65rem;font-family:'Montserrat';color:#8B90A0">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</span></div>
        <div style="grid-column:span 3" class="lg:col-span-3">
          <div style="aspect-ratio:4/3;overflow:hidden;background:#F8F8FA">
            @if($project->hasMedia('gallery'))
              <img src="{{ $project->getFirstMediaUrl('gallery','medium') }}" alt="{{ $project->brand }}" style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s ease" loading="lazy" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            @else
              <div style="width:100%;height:100%;background:#E2E4EA;display:flex;align-items:center;justify-content:center"><span style="font-family:'Cormorant Garamond',serif;font-size:2rem;color:#8B90A0">{{ substr($project->brand,0,1) }}</span></div>
            @endif
          </div>
        </div>
        <div style="grid-column:span 7;display:flex;flex-direction:column;justify-content:center;padding-left:1rem" class="lg:col-span-7 lg:pl-8">
          <div style="display:flex;align-items:center;gap:1rem;margin-bottom:0.75rem">
            <p class="section-tag">{{ $project->service_type }}</p>
            <span style="color:#E2E4EA">—</span>
            <p style="font-size:0.75rem;color:#8B90A0">{{ $project->year }}</p>
          </div>
          <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(1.5rem,3vw,2.25rem);color:#0B132B;font-weight:400;line-height:1.2;margin-bottom:0.75rem">{{ $project->brand }}</h2>
          @if($project->description)<p style="font-size:0.8rem;color:#5E6472;line-height:1.8">{{ Str::limit($project->description,160) }}</p>@endif
        </div>
        <div style="grid-column:span 1;display:flex;align-items:center;justify-content:flex-end" class="lg:col-span-1">
          <svg style="width:1.25rem;height:1.25rem;color:#8B90A0;transition:all 0.3s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </div>
      </a>
      @empty
      <div style="padding:5rem 0;text-align:center;border-top:1px solid #E2E4EA">
        <p style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;color:#8B90A0">Projects coming soon</p>
      </div>
      @endforelse
    </div>
    @if($projects->hasPages())<div style="margin-top:2rem;display:flex;justify-content:center">{{ $projects->links() }}</div>@endif
  </div>
</div>
@endsection
