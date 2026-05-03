@extends('layouts.app')
@section('title','Talent Directory')
@section('description','Browse the AYKA Originals talent roster — extraordinary models for luxury fashion, editorial and commercial bookings.')
@section('content')
<div style="padding-top:7rem;padding-bottom:5rem" class="px-6 lg:px-16">
  <div style="max-width:1280px;margin:0 auto">
    <div style="margin-bottom:3rem" data-animate>
      <p class="section-tag" style="margin-bottom:0.75rem">Our Roster</p>
      <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(3rem,6vw,5rem);color:#0B132B;font-weight:400;line-height:1">Talent<br><em>Directory</em></h1>
    </div>

    <div style="display:flex;flex-wrap:wrap;gap:0.5rem;align-items:center;margin-bottom:2.5rem">
      <span class="section-tag" style="margin-right:0.75rem">Filter:</span>
      <a href="{{ route('talent.index', array_merge(request()->except('gender'))) }}" class="{{ !request('gender') ? 'filter-btn-active' : 'filter-btn' }}">All</a>
      @foreach(['female'=>'Women','male'=>'Men','non-binary'=>'Non-Binary'] as $v => $l)
      <a href="{{ route('talent.index', array_merge(request()->all(), ['gender'=>$v])) }}" class="{{ request('gender')===$v ? 'filter-btn-active' : 'filter-btn' }}">{{ $l }}</a>
      @endforeach
      @if($categories->count())
      <span style="width:1px;height:1rem;background:#E2E4EA;margin:0 0.5rem" class="hidden sm:block"></span>
      <a href="{{ route('talent.index', request()->except('category')) }}" class="{{ !request('category') ? 'filter-btn-active' : 'filter-btn' }}">All Types</a>
      @foreach($categories as $cat)
      <a href="{{ route('talent.index', array_merge(request()->all(), ['category'=>$cat])) }}" class="{{ request('category')===$cat ? 'filter-btn-active' : 'filter-btn' }}">{{ ucfirst($cat) }}</a>
      @endforeach
      @endif
    </div>

    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:2rem" class="md:grid-cols-3 lg:grid-cols-4">
      @forelse($talents as $talent)
      <a href="{{ route('talent.show',$talent->slug) }}" class="talent-card" style="transition: transform 0.3s; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05);" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.05)';">
        <div style="aspect-ratio:4/5;position:relative;overflow:hidden;background:#F8F8FA">
          @if($talent->hasMedia('profile'))
            <img src="{{ $talent->getFirstMediaUrl('profile','medium') }}" alt="{{ $talent->name }}"
                 class="talent-card-img" style="width:100%;height:100%;object-fit:cover;object-position:top">
          @else
            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center">
              <span style="font-family:'Cormorant Garamond',serif;font-size:3rem;color:#8B90A0">{{ substr($talent->name,0,1) }}</span>
            </div>
          @endif
          <div class="talent-card-overlay"></div>
        </div>
        <div style="padding:1rem; background:#fff">
          <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.25rem;color:#0B132B; margin-bottom: 0.25rem">{{ $talent->name }}</h3>
          <div style="display:flex;justify-content:space-between;align-items:center">
            <p style="font-size:0.65rem;letter-spacing:0.1em;text-transform:uppercase;color:#5E6472">{{ $talent->category ?? 'Model' }}</p>
            <p style="font-size:0.65rem;color:#8B90A0; font-weight: 500;">{{ $talent->height }}</p>
          </div>
        </div>
      </a>
      @empty
      <div style="grid-column:1/-1;padding:5rem 0;text-align:center">
        <p style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;color:#8B90A0;margin-bottom:0.75rem">No talent found</p>
        <a href="{{ route('talent.index') }}" class="btn-outline-navy" style="margin-top:1rem">Clear Filters</a>
      </div>
      @endforelse
    </div>
    @if($talents->hasPages())<div style="margin-top:3rem;display:flex;justify-content:center">{{ $talents->links() }}</div>@endif
  </div>
</div>
@endsection
