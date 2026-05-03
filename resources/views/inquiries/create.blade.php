@extends('layouts.app')
@section('title','Booking Inquiry')
@section('description','Submit a talent booking or production inquiry to AYKA Originals.')
@section('content')
<div style="padding-top:7rem;padding-bottom:5rem" class="px-6 lg:px-16">
  <div style="max-width:1280px;margin:0 auto">
    <div style="display:grid;grid-template-columns:1fr;gap:5rem" class="lg:grid-cols-2">
      <div>
        <p class="section-tag" style="margin-bottom:1rem">Work With Us</p>
        <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,5vw,4rem);color:#0B132B;font-weight:400;line-height:1.1;margin-bottom:2.5rem">Submit an<br><em>Inquiry</em></h1>
        <p style="font-size:0.85rem;color:#5E6472;line-height:1.9;max-width:360px;margin-bottom:3rem">Tell us about your project and requirements. Our team will respond within 24 hours.</p>
        <div style="display:flex;flex-direction:column;gap:1.75rem">
          @foreach([['Bookings',\App\Models\SiteSetting::get('site_email','bookings@aykaoriginals.com'),''],['Response Time','Within 24 hours',''],['Office Hours','Monday – Friday, 9AM – 6PM','']] as [$l,$v,$_])
          <div>
            <p class="stat-label" style="margin-bottom:0.35rem">{{ $l }}</p>
            <p style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;color:#0B132B">{{ $v }}</p>
          </div>
          @endforeach
        </div>
      </div>
      <div>
        @if(session('success'))
        <div style="background:#d1fae5;border-left:3px solid #0B132B;padding:1rem 1.25rem;margin-bottom:2rem;font-size:0.85rem;color:#065f46">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('inquiries.store') }}" style="display:flex;flex-direction:column;gap:2rem">
          @csrf
          @if(request('talent'))<input type="hidden" name="talent_id" value="{{ request('talent') }}">@endif
          @foreach([['Full Name *','name','text','Your name'],['Email Address *','email','email','your@email.com'],['Company / Brand','company','text','Your company']] as [$l,$n,$t,$p])
          <div>
            <label class="stat-label" style="display:block;margin-bottom:0.5rem">{{ $l }}</label>
            <input type="{{ $t }}" name="{{ $n }}" value="{{ old($n) }}" {{ str_ends_with($l,'*') ? 'required' : '' }} class="form-field" placeholder="{{ $p }}">
            @error($n)<p style="font-size:0.75rem;color:#dc2626;margin-top:0.35rem">{{ $message }}</p>@enderror
          </div>
          @endforeach
          <div>
            <label class="stat-label" style="display:block;margin-bottom:0.5rem">Inquiry Type *</label>
            <select name="type" required class="form-field" style="border:0;border-bottom:1px solid #E2E4EA;background:transparent">
              <option value="">Select a service</option>
              @foreach(['talent_booking'=>'Talent Booking','campaign_production'=>'Campaign Production','editorial'=>'Editorial','lookbook'=>'Lookbook','other'=>'Other'] as $v => $l)
              <option value="{{ $v }}" {{ old('type')===$v?'selected':'' }}>{{ $l }}</option>
              @endforeach
            </select>
            @error('type')<p style="font-size:0.75rem;color:#dc2626;margin-top:0.35rem">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="stat-label" style="display:block;margin-bottom:0.5rem">Project Details *</label>
            <textarea name="message" required rows="5" class="form-field" style="resize:none" placeholder="Describe your project, timeline, and requirements...">{{ old('message') }}</textarea>
            @error('message')<p style="font-size:0.75rem;color:#dc2626;margin-top:0.35rem">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="stat-label" style="display:block;margin-bottom:0.5rem">Budget Range</label>
            <select name="budget" class="form-field" style="border:0;border-bottom:1px solid #E2E4EA;background:transparent">
              <option value="">Select range</option>
              @foreach(['under_5k'=>'Under $5,000','5k_15k'=>'$5,000 – $15,000','15k_50k'=>'$15,000 – $50,000','50k_plus'=>'$50,000+'] as $v => $l)
              <option value="{{ $v }}" {{ old('budget')===$v?'selected':'' }}>{{ $l }}</option>
              @endforeach
            </select>
          </div>
          <div style="padding-top:0.5rem">
            <button type="submit" class="btn-navy" style="width:100%;justify-content:center">Submit Inquiry</button>
            <p style="font-size:0.7rem;color:#8B90A0;text-align:center;margin-top:0.75rem">We'll respond within 24 hours.</p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
