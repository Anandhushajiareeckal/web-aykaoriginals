@extends('model.layouts.app')
@section('title','My Portfolio')
@section('content')

<div x-data="{ lightboxOpen: false, lightboxSrc: '', openLightbox(src){ this.lightboxSrc=src; this.lightboxOpen=true; } }">

  {{-- Upload Panel --}}
  <div class="panel" style="margin-bottom:1.5rem">
    <div class="panel-header">
      <div>
        <span class="panel-title">Upload to Portfolio</span>
        <p style="font-size:.72rem;color:var(--slate2);margin-top:.2rem">{{ $portfolio->count() }} images</p>
      </div>
    </div>
    <div class="panel-body">
      <form method="POST" action="{{ route('model.portfolio.upload') }}" enctype="multipart/form-data">
        @csrf
        <div style="margin-bottom:1rem">
          <label class="form-label">Category</label>
          <select name="category" class="form-control" style="max-width:240px">
            @foreach(['fashion','editorial','commercial','runway','lifestyle','swimwear','general'] as $cat)
            <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
            @endforeach
          </select>
        </div>
        <div style="border:2px dashed var(--border);border-radius:12px;padding:2rem;text-align:center;background:var(--off);position:relative;transition:border-color .2s" id="drop-zone">
          <svg style="width:2rem;height:2rem;color:var(--slate2);margin:0 auto .75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
          <p style="font-weight:600;color:var(--navy);margin-bottom:.25rem">Drop images here or click to browse</p>
          <p style="font-size:.72rem;color:var(--slate2)">JPG, PNG, WebP · Max 15MB each</p>
          <input type="file" name="images[]" accept="image/*" multiple style="position:absolute;inset:0;opacity:0;cursor:pointer" onchange="previewFiles(this)">
        </div>
        <div id="preview-row" style="display:flex;flex-wrap:wrap;gap:.5rem;margin-top:.75rem"></div>
        <div style="display:flex;justify-content:flex-end;margin-top:.75rem">
          <button type="submit" class="btn btn-primary" id="upload-btn" disabled>
            <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
            Upload Images
          </button>
        </div>
      </form>
    </div>
  </div>

  {{-- Portfolio Grid --}}
  @if($portfolio->count())
  <div class="panel">
    <div class="panel-header">
      <span class="panel-title">Portfolio ({{ $portfolio->count() }})</span>
      <span style="font-size:.7rem;color:var(--slate2)">Click to preview</span>
    </div>
    <div class="panel-body">
      {{-- Category Filter --}}
      <div style="display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.25rem">
        <button onclick="filterCat(this,'')" class="cat-btn active">All</button>
        @foreach($portfolio->groupBy(fn($m) => $m->getCustomProperty('category','general')) as $cat => $items)
        <button onclick="filterCat(this,'{{ $cat }}')" class="cat-btn">{{ ucfirst($cat) }} ({{ count($items) }})</button>
        @endforeach
      </div>
      {{-- Grid --}}
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:.75rem">
        @foreach($portfolio as $img)
        <div class="p-item" data-cat="{{ $img->getCustomProperty('category','general') }}" style="position:relative;aspect-ratio:2/3;border-radius:10px;overflow:hidden;cursor:pointer;background:var(--off)" @click="openLightbox('{{ $img->getUrl('large') }}')">
          <img src="{{ $img->getUrl('thumb') }}" style="width:100%;height:100%;object-fit:cover;object-position:top" loading="lazy">
          <div style="position:absolute;inset:0;background:rgba(11,19,43,.35);opacity:0;transition:opacity .2s;display:flex;align-items:center;justify-content:center" onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0">
            <svg style="width:1.5rem;height:1.5rem;color:#fff" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          </div>
          <div style="position:absolute;bottom:0;left:0;right:0;padding:.4rem .5rem;background:linear-gradient(to top,rgba(0,0,0,.6),transparent);display:flex;justify-content:space-between;align-items:center">
            <span style="font-size:.55rem;letter-spacing:.1em;text-transform:uppercase;color:rgba(255,255,255,.7)">{{ $img->getCustomProperty('category','general') }}</span>
            <form method="POST" action="{{ route('model.portfolio.destroy',$img->id) }}" @click.stop onsubmit="return confirm('Remove?')">
              @csrf @method('DELETE')
              <button type="submit" style="width:20px;height:20px;background:rgba(239,68,68,.85);border:none;border-radius:4px;cursor:pointer;color:#fff;display:flex;align-items:center;justify-content:center">
                <svg style="width:.6rem;height:.6rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
              </button>
            </form>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @else
  <div class="panel">
    <div class="panel-body" style="text-align:center;padding:4rem">
      <div style="font-size:3rem;margin-bottom:1rem">📸</div>
      <p style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;font-weight:400;color:var(--navy);margin-bottom:.75rem">Your portfolio is empty</p>
      <p style="font-size:.82rem;color:var(--slate2)">Upload your best work to build a stunning portfolio grid.</p>
    </div>
  </div>
  @endif

  {{-- Lightbox --}}
  <div x-show="lightboxOpen" x-cloak @keydown.escape.window="lightboxOpen=false" @click.self="lightboxOpen=false" style="position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:1000;display:flex;align-items:center;justify-content:center;padding:2rem">
    <button @click="lightboxOpen=false" style="position:absolute;top:1.5rem;right:1.5rem;background:rgba(255,255,255,.1);border:none;width:40px;height:40px;border-radius:8px;color:#fff;font-size:1.1rem;cursor:pointer">✕</button>
    <img :src="lightboxSrc" style="max-height:90vh;max-width:90vw;object-fit:contain;border-radius:6px">
  </div>

</div>

<style>
.cat-btn{padding:.3rem .75rem;border-radius:999px;font-size:.7rem;font-weight:500;border:1px solid var(--border);background:var(--off);color:var(--slate);cursor:pointer;transition:all .2s}
.cat-btn:hover,.cat-btn.active{background:var(--accent);color:#fff;border-color:var(--accent)}
</style>

@endsection
@push('scripts')
<script>
function filterCat(btn, cat) {
  document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.querySelectorAll('.p-item').forEach(item => {
    item.style.display = (!cat || item.dataset.cat === cat) ? '' : 'none';
  });
}
function previewFiles(input) {
  const row = document.getElementById('preview-row');
  const btn = document.getElementById('upload-btn');
  row.innerHTML = '';
  if (input.files.length > 0) {
    btn.disabled = false;
    Array.from(input.files).slice(0, 12).forEach(file => {
      const reader = new FileReader();
      reader.onload = e => {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.style.cssText = 'width:56px;height:75px;object-fit:cover;border-radius:6px;border:1px solid var(--border)';
        row.appendChild(img);
      };
      reader.readAsDataURL(file);
    });
  } else { btn.disabled = true; }
}
</script>
@endpush
