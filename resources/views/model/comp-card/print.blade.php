<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $talent->name }} — Comp Card | AYKA Originals</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'Montserrat',sans-serif;background:#fff;color:#0B132B;-webkit-print-color-adjust:exact;print-color-adjust:exact}

    .comp-card{width:210mm;min-height:297mm;padding:12mm;display:flex;flex-direction:column;background:#fff;position:relative}

    .comp-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:8mm;padding-bottom:5mm;border-bottom:0.5pt solid #e5e7eb}
    .comp-name{font-family:'Cormorant Garamond',serif;font-size:28pt;font-weight:300;letter-spacing:2pt;color:#0B132B;line-height:1}
    .comp-category{font-size:6pt;letter-spacing:3pt;text-transform:uppercase;color:#8B90A0;margin-top:2mm}
    .comp-agency{text-align:right}
    .comp-agency-name{font-family:'Cormorant Garamond',serif;font-size:14pt;letter-spacing:3pt;color:#0B132B}
    .comp-agency-sub{font-size:5pt;letter-spacing:4pt;text-transform:uppercase;color:#C9A96E;margin-top:1mm}

    .comp-images{display:grid;grid-template-columns:2fr 1fr;grid-template-rows:repeat(2,minmax(0,1fr));gap:4mm;margin-bottom:8mm;flex:1}
    .comp-img-main{grid-row:span 2;overflow:hidden;border-radius:2mm;background:#f5f5f5}
    .comp-img-main img{width:100%;height:100%;object-fit:cover;object-position:top;display:block}
    .comp-img-small{overflow:hidden;border-radius:2mm;background:#f5f5f5}
    .comp-img-small img{width:100%;height:100%;object-fit:cover;object-position:top;display:block}
    .comp-img-placeholder{width:100%;height:100%;background:linear-gradient(160deg,#f9f9f9,#f0f0f0);display:flex;align-items:center;justify-content:center}
    .comp-img-placeholder span{color:#d1d5db;font-size:18pt}

    .comp-measurements{border-top:0.5pt solid #e5e7eb;padding-top:5mm;margin-bottom:5mm}
    .comp-measurements-title{font-size:5pt;letter-spacing:4pt;text-transform:uppercase;color:#8B90A0;margin-bottom:3mm}
    .comp-measurements-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(30mm,1fr));gap:3mm}
    .comp-measurement-item{text-align:center;padding:2mm;border:0.3pt solid #e5e7eb;border-radius:1mm}
    .comp-measurement-label{font-size:4.5pt;letter-spacing:2pt;text-transform:uppercase;color:#8B90A0;margin-bottom:1mm}
    .comp-measurement-value{font-size:8pt;font-weight:600;color:#0B132B}

    .comp-footer{display:flex;justify-content:space-between;align-items:flex-end;padding-top:4mm;border-top:0.5pt solid #e5e7eb}
    .comp-contact{font-size:6pt;color:#8B90A0;line-height:1.8}
    .comp-watermark{font-family:'Cormorant Garamond',serif;font-size:8pt;letter-spacing:3pt;color:#e5e7eb;text-transform:uppercase}

    @media print {
      body{margin:0;padding:0}
      .no-print{display:none!important}
      .comp-card{margin:0;width:100%}
      @page{size:A4;margin:0}
    }
  </style>
</head>
<body>

{{-- Print controls --}}
<div class="no-print" style="background:#0B132B;color:#fff;padding:1rem 2rem;display:flex;align-items:center;justify-content:space-between;font-family:'Montserrat',sans-serif">
  <span style="font-size:.8rem;color:rgba(255,255,255,.6)">Comp Card — Print Preview</span>
  <div style="display:flex;gap:.75rem">
    <button onclick="window.print()" style="padding:.5rem 1.25rem;background:linear-gradient(135deg,#C9A96E,#e8c07a);border:none;border-radius:6px;color:#fff;font-size:.78rem;font-weight:600;cursor:pointer;font-family:'Montserrat',sans-serif">🖨 Print / Save as PDF</button>
    <a href="{{ route('model.comp-card.index') }}" style="padding:.5rem 1.25rem;border:1px solid rgba(255,255,255,.2);border-radius:6px;color:rgba(255,255,255,.7);font-size:.78rem;font-family:'Montserrat',sans-serif;cursor:pointer">← Back</a>
  </div>
</div>

{{-- Comp Card --}}
<div style="display:flex;justify-content:center;padding:20px;background:#f0f0f0;min-height:calc(100vh - 60px)" class="no-print-bg">
<div class="comp-card" style="box-shadow:0 4px 40px rgba(0,0,0,.15)">

  {{-- Header --}}
  <div class="comp-header">
    <div>
      <div class="comp-name">{{ $talent->name }}</div>
      @if($talent->category)<div class="comp-category">{{ $talent->category }}</div>@endif
      @if($talent->location)<div style="font-size:6pt;color:#8B90A0;margin-top:1mm;letter-spacing:1pt">📍 {{ $talent->location }}</div>@endif
    </div>
    <div class="comp-agency">
      <div class="comp-agency-name">AYKA</div>
      <div class="comp-agency-sub">Originals</div>
    </div>
  </div>

  {{-- Images --}}
  <div class="comp-images">
    {{-- Main image --}}
    <div class="comp-img-main">
      @if($compImages->count() > 0)
      <img src="{{ $compImages->first()->getUrl('large') }}" alt="{{ $talent->name }}">
      @else
      <div class="comp-img-placeholder"><span>📷</span></div>
      @endif
    </div>

    {{-- Small images --}}
    @for($i = 1; $i <= 2; $i++)
    <div class="comp-img-small">
      @if($compImages->count() > $i)
      <img src="{{ $compImages[$i]->getUrl('medium') }}" alt="{{ $talent->name }} {{ $i+1 }}">
      @else
      <div class="comp-img-placeholder"><span style="font-size:10pt">+</span></div>
      @endif
    </div>
    @endfor
  </div>

  {{-- Measurements --}}
  <div class="comp-measurements">
    <div class="comp-measurements-title">Model Measurements</div>
    <div class="comp-measurements-grid">
      @foreach([
        ['Height', $talent->height],
        ['Chest / Bust', $talent->chest_bust],
        ['Waist', $talent->waist],
        ['Hips', $talent->hips],
        ['Weight', $talent->weight],
        ['Inseam', $talent->inseam],
        ['Shoe Size', $talent->shoe_size],
        ['Eye Color', $talent->eye_color],
        ['Hair Color', $talent->hair_color],
      ] as [$label, $value])
      @if($value)
      <div class="comp-measurement-item">
        <div class="comp-measurement-label">{{ $label }}</div>
        <div class="comp-measurement-value">{{ $value }}</div>
      </div>
      @endif
      @endforeach
    </div>
  </div>

  {{-- Footer --}}
  <div class="comp-footer">
    <div class="comp-contact">
      <div style="font-size:7pt;font-weight:600;color:#0B132B;letter-spacing:1pt;margin-bottom:1mm">REPRESENTED BY AYKA ORIGINALS</div>
      @if(!empty($talent->social_links['instagram']))<div>Instagram: {{ $talent->social_links['instagram'] }}</div>@endif
    </div>
    <div class="comp-watermark">AYKA Originals</div>
  </div>

</div>
</div>

<style>
  @media screen { .no-print-bg { background:#f0f0f0!important; } }
  @media print { .no-print-bg { background:#fff!important; padding:0!important; } }
</style>
</body>
</html>
