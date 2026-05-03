@extends('model.layouts.app')
@section('title','Comp Card Builder')
@section('content')

<style>
@media(max-width:900px){
  .comp-card-grid{grid-template-columns:1fr !important}
  #upload-zone{padding:1rem !important}
}
</style>
<div class="comp-card-grid" style="display:grid;grid-template-columns:1fr 380px;gap:1.5rem;align-items:start">

  {{-- ── Left: Upload Section ── --}}
  <div>

    {{-- Upload Panel --}}
    <div class="panel" style="margin-bottom:1.25rem">
      <div class="panel-header">
        <span class="panel-title">Upload Comp Card Images</span>
        <span style="font-size:.72rem;color:var(--slate2)">{{ $compImages->count() }}/5 images</span>
      </div>
      <div class="panel-body">
        <form method="POST" action="{{ route('model.comp-card.upload') }}" enctype="multipart/form-data">
          @csrf
          <div style="border:2px dashed var(--border);border-radius:12px;padding:2rem;text-align:center;background:var(--off);cursor:pointer;transition:all .2s;position:relative" id="upload-zone" ondragover="event.preventDefault();this.style.borderColor='var(--accent)';this.style.background='rgba(108,99,255,.04)'" ondragleave="this.style.borderColor='var(--border)';this.style.background='var(--off)'" ondrop="handleDrop(event)">
            <svg style="width:2.5rem;height:2.5rem;color:var(--slate2);margin:0 auto 1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
            <p style="font-size:.875rem;font-weight:600;color:var(--navy);margin-bottom:.35rem">Drop images here or click to browse</p>
            <p style="font-size:.72rem;color:var(--slate2)">Recommended: high-res JPG/PNG · Max 10MB each · Up to 5 images</p>
            <input type="file" id="comp-file-input" name="images[]" accept="image/*" multiple style="position:absolute;inset:0;opacity:0;cursor:pointer" onchange="previewCompFiles(this)">
          </div>

          <div id="comp-preview-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:.5rem;margin-top:.875rem"></div>

          <div style="display:flex;justify-content:flex-end;margin-top:1rem">
            <button type="submit" class="btn btn-gold" id="upload-btn" disabled>
              <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
              Upload Selected Images
            </button>
          </div>
        </form>
      </div>
    </div>

    {{-- Uploaded Images --}}
    @if($compImages->count())
    <div class="panel">
      <div class="panel-header">
        <span class="panel-title">Your Comp Card Images</span>
        <a href="{{ route('model.comp-card.download') }}" target="_blank" class="btn btn-gold btn-sm">
          <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
          Download / Print
        </a>
      </div>
      <div class="panel-body">
        <p style="font-size:.72rem;color:var(--slate2);margin-bottom:1rem">💡 Tip: The first image will be used as the main (front) photo on your comp card. Re-arrange by deleting and re-uploading in your preferred order.</p>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:.75rem">
          @foreach($compImages as $i => $img)
          <div style="position:relative;border-radius:10px;overflow:hidden;aspect-ratio:2/3;background:var(--off)">
            <img src="{{ $img->getUrl('medium') }}" style="width:100%;height:100%;object-fit:cover" loading="lazy" alt="Comp card image {{ $i+1 }}">
            <div style="position:absolute;top:0;left:0;right:0;padding:.5rem;display:flex;justify-content:space-between;align-items:center;background:linear-gradient(to bottom,rgba(0,0,0,.5),transparent)">
              <span style="font-size:.65rem;font-weight:700;color:#fff;background:rgba(0,0,0,.4);padding:.15rem .4rem;border-radius:4px">
                {{ $i === 0 ? 'MAIN' : ($i === 1 ? 'SIDE' : 'EXTRA') }}
              </span>
            </div>
            <div style="position:absolute;bottom:0;left:0;right:0;padding:.5rem;background:linear-gradient(to top,rgba(0,0,0,.5),transparent);display:flex;justify-content:flex-end">
              <form method="POST" action="{{ route('model.comp-card.delete', $img->id) }}" onsubmit="return confirm('Remove this image?')">
                @csrf @method('DELETE')
                <button type="submit" style="width:26px;height:26px;background:rgba(239,68,68,.85);border:none;border-radius:6px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#fff;transition:background .2s" onmouseover="this.style.background='#ef4444'" onmouseout="this.style.background='rgba(239,68,68,.85)'">
                  <svg style="width:.7rem;height:.7rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
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
      <div class="panel-body" style="text-align:center;padding:3rem">
        <div style="font-size:3rem;margin-bottom:1rem">🪪</div>
        <p style="font-weight:600;color:var(--navy);margin-bottom:.5rem">No comp card images yet</p>
        <p style="font-size:.8rem;color:var(--slate2)">Upload your photos above to build your professional comp card.</p>
      </div>
    </div>
    @endif
  </div>

  {{-- ── Right: Comp Card Preview ── --}}
  <div style="position:sticky;top:80px">
    <div class="panel">
      <div class="panel-header">
        <span class="panel-title">Comp Card Preview</span>
        @if($compImages->count() > 0)
        <a href="{{ route('model.comp-card.download') }}" target="_blank" style="font-size:.7rem;color:var(--accent);font-weight:600">Print ↗</a>
        @endif
      </div>
      <div class="panel-body" style="padding:.75rem">
        {{-- Comp Card Layout A4-ratio preview --}}
        <div style="background:#fff;border:1px solid var(--border);border-radius:8px;padding:.75rem;font-family:'Cormorant Garamond',serif;aspect-ratio:148/210;overflow:hidden;position:relative">
          {{-- Header --}}
          <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:.5rem;border-bottom:1px solid #e5e7eb;padding-bottom:.35rem">
            <div>
              <div style="font-size:.7rem;font-weight:600;letter-spacing:.15em;color:#0B132B">{{ $talent->name }}</div>
              <div style="font-size:.45rem;letter-spacing:.1em;color:#8B90A0;text-transform:uppercase">{{ $talent->category }}</div>
            </div>
            <div style="font-size:.35rem;letter-spacing:.15em;color:#8B90A0;text-align:right;text-transform:uppercase;font-family:'Inter',sans-serif">AYKA<br>Originals</div>
          </div>

          {{-- Images grid --}}
          <div style="display:grid;grid-template-columns:2fr 1fr;grid-template-rows:1fr 1fr;gap:.35rem;height:65%;margin-bottom:.5rem">
            @if($compImages->count() > 0)
            <div style="grid-row:span 2;border-radius:4px;overflow:hidden;background:#f5f5f5">
              <img src="{{ $compImages->first()->getUrl('medium') }}" style="width:100%;height:100%;object-fit:cover;object-position:top">
            </div>
            @else
            <div style="grid-row:span 2;border-radius:4px;background:linear-gradient(160deg,#f5f5f5,#e5e7eb);display:flex;align-items:center;justify-content:center">
              <span style="font-size:1.5rem;color:#d1d5db">📷</span>
            </div>
            @endif
            @for($i=1;$i<=2;$i++)
            <div style="border-radius:4px;overflow:hidden;background:#f5f5f5">
              @if($compImages->count() > $i)
              <img src="{{ $compImages[$i]->getUrl('thumb') }}" style="width:100%;height:100%;object-fit:cover;object-position:top">
              @else
              <div style="width:100%;height:100%;background:linear-gradient(160deg,#f5f5f5,#e5e7eb);display:flex;align-items:center;justify-content:center">
                <span style="font-size:.6rem;color:#d1d5db">+</span>
              </div>
              @endif
            </div>
            @endfor
          </div>

          {{-- Measurements --}}
          <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:.25rem;font-family:'Inter',sans-serif">
            @foreach([['H',$talent->height],['B',$talent->chest_bust],['W',$talent->waist],['Hip',$talent->hips],['Shoes',$talent->shoe_size],['Eyes',$talent->eye_color],['Hair',$talent->hair_color],['Loc.',$talent->location]] as [$k,$v])
            @if($v)
            <div style="text-align:center">
              <div style="font-size:.3rem;letter-spacing:.08em;text-transform:uppercase;color:#8B90A0">{{ $k }}</div>
              <div style="font-size:.4rem;font-weight:600;color:#0B132B">{{ $v }}</div>
            </div>
            @endif
            @endforeach
          </div>
        </div>
        <p style="font-size:.65rem;color:var(--slate2);text-align:center;margin-top:.75rem">This is a scaled preview. Click "Print" for the full A4 comp card.</p>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')
<script>
function previewCompFiles(input) {
  const grid = document.getElementById('comp-preview-grid');
  const btn  = document.getElementById('upload-btn');
  grid.innerHTML = '';
  if (input.files.length > 0) {
    btn.disabled = false;
    Array.from(input.files).forEach(file => {
      const reader = new FileReader();
      reader.onload = e => {
        const div = document.createElement('div');
        div.style.cssText = 'aspect-ratio:2/3;border-radius:8px;overflow:hidden;border:1px solid var(--border)';
        const img = document.createElement('img');
        img.src = e.target.result;
        img.style.cssText = 'width:100%;height:100%;object-fit:cover';
        div.appendChild(img);
        grid.appendChild(div);
      };
      reader.readAsDataURL(file);
    });
  } else {
    btn.disabled = true;
  }
}
</script>
@endpush
