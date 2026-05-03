@extends('layouts.app')
@section('title', $post->title)
@section('description', $post->excerpt ? Str::limit($post->excerpt,160) : $post->title . ' — AYKA Originals Journal.')
@section('content')
<div style="padding-top:7rem">
  @if($post->hasMedia('cover'))
  <div style="height:55vh;overflow:hidden">
    <img src="{{ $post->getFirstMediaUrl('cover','large') }}" alt="{{ $post->title }}" style="width:100%;height:100%;object-fit:cover" loading="eager">
  </div>
  @endif
  <div style="max-width:760px;margin:0 auto;padding:4rem 1.5rem 6rem" class="px-6">
    <div style="margin-bottom:2rem">
      <a href="{{ route('blog.index') }}" style="display:inline-flex;align-items:center;gap:0.5rem;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472" onmouseover="this.style.color='#0B132B'" onmouseout="this.style.color='#5E6472'">
        <svg style="width:0.75rem;height:0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
        Journal
      </a>
    </div>
    @if($post->category)<p class="section-tag" style="margin-bottom:1rem">{{ $post->category }}</p>@endif
    <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2rem,5vw,3.5rem);color:#0B132B;font-weight:400;line-height:1.2;margin-bottom:1rem">{{ $post->title }}</h1>
    <p style="font-size:0.75rem;color:#8B90A0;margin-bottom:3rem">{{ $post->published_at?->format('M d, Y') }}</p>
    @if($post->excerpt)<p style="font-size:1rem;color:#5E6472;line-height:1.9;margin-bottom:2.5rem;font-family:'Cormorant Garamond',serif;font-style:italic;font-size:1.1rem">{{ $post->excerpt }}</p>@endif
    <div style="font-size:0.9rem;color:#0B132B;line-height:2;border-top:1px solid #E2E4EA;padding-top:2.5rem" class="prose max-w-none">
      {!! $post->content !!}
    </div>
    @if($related->count())
    <div style="margin-top:5rem;padding-top:3rem;border-top:1px solid #E2E4EA">
      <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;color:#0B132B;margin-bottom:1.5rem;font-weight:400">More from the Journal</h3>
      <div style="display:grid;grid-template-columns:1fr;gap:1.5rem" class="md:grid-cols-3">
        @foreach($related as $r)
        <a href="{{ route('blog.show',$r->slug) }}" style="display:block">
          <p style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;color:#0B132B;line-height:1.4">{{ $r->title }}</p>
          <p style="font-size:0.7rem;color:#8B90A0;margin-top:0.4rem">{{ $r->published_at?->format('M d, Y') }}</p>
        </a>
        @endforeach
      </div>
    </div>
    @endif
  </div>
</div>
@endsection
