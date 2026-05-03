@extends('layouts.app')
@section('title','Journal')
@section('description','AYKA Originals Journal — industry insights, campaign features, and agency news.')
@section('content')
<div style="padding-top:7rem;padding-bottom:5rem" class="px-6 lg:px-16">
  <div style="max-width:1280px;margin:0 auto">
    <div style="margin-bottom:3.5rem" data-animate>
      <p class="section-tag" style="margin-bottom:0.75rem">Journal</p>
      <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(3rem,6vw,5rem);color:#0B132B;font-weight:400;line-height:1">Latest<br><em>Insights</em></h1>
    </div>
    <div style="display:grid;grid-template-columns:1fr;gap:2rem" class="md:grid-cols-2 lg:grid-cols-3">
      @forelse($posts as $post)
      <a href="{{ route('blog.show',$post->slug) }}" style="display:block;text-decoration:none">
        <div style="aspect-ratio:16/9;overflow:hidden;background:#F8F8FA;margin-bottom:1.25rem">
          @if($post->hasMedia('cover'))
            <img src="{{ $post->getFirstMediaUrl('cover','medium') }}" alt="{{ $post->title }}"
                 style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s ease" loading="lazy"
                 onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'">
          @else
            <div style="width:100%;height:100%;background:linear-gradient(135deg,#0B132B 0%,#1C2951 100%);display:flex;align-items:center;justify-content:center">
              <span style="font-family:'Cormorant Garamond',serif;font-size:2rem;color:rgba(255,255,255,0.3)">AO</span>
            </div>
          @endif
        </div>
        <div>
          @if($post->category)<p class="section-tag" style="margin-bottom:0.5rem">{{ $post->category }}</p>@endif
          <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.4rem;color:#0B132B;font-weight:400;line-height:1.3;margin-bottom:0.75rem">{{ $post->title }}</h2>
          @if($post->excerpt)<p style="font-size:0.8rem;color:#5E6472;line-height:1.8">{{ Str::limit($post->excerpt,120) }}</p>@endif
          <p style="font-size:0.7rem;color:#8B90A0;margin-top:0.75rem">{{ $post->published_at?->format('M d, Y') }}</p>
        </div>
      </a>
      @empty
      <div style="grid-column:1/-1;padding:5rem 0;text-align:center">
        <p style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;color:#8B90A0">No posts yet</p>
      </div>
      @endforelse
    </div>
    @if($posts->hasPages())<div style="margin-top:3rem;display:flex;justify-content:center">{{ $posts->links() }}</div>@endif
  </div>
</div>
@endsection
