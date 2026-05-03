@extends('layouts.app')
@section('title','Gallery')
@section('description','AYKA Originals Gallery — curated editorial and campaign photography.')
@section('content')
<div style="padding-top:7rem;padding-bottom:5rem" class="px-6 lg:px-16">
  <div style="max-width:1280px;margin:0 auto">
    <div style="margin-bottom:3rem" data-animate>
      <p class="section-tag" style="margin-bottom:0.75rem">Visual Archive</p>
      <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(3rem,6vw,5rem);color:#0B132B;font-weight:400;line-height:1">Gallery</h1>
    </div>

    @if($categories->count())
    <div style="display:flex;flex-wrap:wrap;gap:0.5rem;margin-bottom:2.5rem" x-data="{ active: 'all' }">
      <button @click="active='all'; filterGallery('all')" :class="active==='all' ? 'filter-btn-active' : 'filter-btn'" class="filter-btn">All</button>
      @foreach($categories as $cat)
      <button @click="active='{{ $cat }}'; filterGallery('{{ $cat }}')" :class="active==='{{ $cat }}' ? 'filter-btn-active' : 'filter-btn'" class="filter-btn">{{ ucfirst($cat) }}</button>
      @endforeach
    </div>
    @endif

    <div id="gallery-grid" style="columns:2;gap:1rem;column-count:2" class="md:columns-3 lg:columns-4">
      @forelse($items as $item)
      @if($item->hasMedia('image'))
      <div class="gallery-item break-inside-avoid mb-4" data-category="{{ $item->category }}">
        <div style="overflow:hidden;cursor:pointer" onclick="openLightbox('{{ $item->getFirstMediaUrl('image','large') }}')">
          <img src="{{ $item->getFirstMediaUrl('image','medium') }}" alt="{{ $item->title }}"
               style="width:100%;display:block;transition:transform 0.7s ease" loading="lazy"
               onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform='scale(1)'">
        </div>
        @if($item->title)
        <p style="font-size:0.7rem;color:#5E6472;margin-top:0.4rem;letter-spacing:0.05em">{{ $item->title }}</p>
        @endif
      </div>
      @endif
      @empty
      <div style="column-span:all;padding:5rem 0;text-align:center">
        <p style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;color:#8B90A0">No images yet</p>
      </div>
      @endforelse
    </div>
  </div>
</div>

{{-- Lightbox --}}
<div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(11,19,43,0.96);z-index:100;align-items:center;justify-content:center" onclick="closeLightbox()">
  <button onclick="closeLightbox()" style="position:absolute;top:1.5rem;right:1.5rem;color:#fff;background:none;border:none;cursor:pointer;font-size:1.5rem">✕</button>
  <img id="lightbox-img" src="" style="max-height:90vh;max-width:90vw;object-fit:contain" onclick="event.stopPropagation()">
</div>

@push('scripts')
<script>
function openLightbox(src) {
  document.getElementById('lightbox-img').src = src;
  document.getElementById('lightbox').style.display = 'flex';
  document.body.style.overflow = 'hidden';
}
function closeLightbox() {
  document.getElementById('lightbox').style.display = 'none';
  document.body.style.overflow = '';
}
function filterGallery(cat) {
  document.querySelectorAll('.gallery-item').forEach(el => {
    if (cat === 'all' || el.dataset.category === cat) {
      el.style.display = 'block';
    } else {
      el.style.display = 'none';
    }
  });
}
document.addEventListener('keydown', e => { if(e.key === 'Escape') closeLightbox(); });
</script>
@endpush
@endsection
