@extends('layouts.app')
@section('title','Services')
@section('description','AYKA Originals services — talent management, campaign production, editorial direction, and brand consulting.')
@section('content')
<div style="padding-top:7rem;padding-bottom:5rem" class="px-6 lg:px-16">
  <div style="max-width:1280px;margin:0 auto">
    <div style="margin-bottom:4rem" data-animate>
      <p class="section-tag" style="margin-bottom:0.75rem">What We Offer</p>
      <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(3rem,6vw,5rem);color:#0B132B;font-weight:400;line-height:1">Our<br><em>Services</em></h1>
    </div>

    <div style="display:flex;flex-direction:column">
      @forelse($services as $i => $service)
      <div style="display:grid;grid-template-columns:1fr;gap:2rem;padding:3rem 0;border-top:1px solid #E2E4EA" class="lg:grid-cols-12" data-animate>
        <div style="grid-column:span 1;display:flex;align-items:flex-start;padding-top:0.25rem" class="lg:col-span-1">
          <span style="font-size:0.7rem;color:#8B90A0;font-family:'Montserrat',sans-serif">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</span>
        </div>
        <div style="grid-column:span 4" class="lg:col-span-4">
          <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(1.5rem,3vw,2.25rem);color:#0B132B;font-weight:400;line-height:1.2">{{ $service->title }}</h2>
        </div>
        <div style="grid-column:span 7" class="lg:col-span-7">
          <p style="font-size:0.9rem;color:#5E6472;line-height:1.9;margin-bottom:1.5rem">{{ $service->description }}</p>
          @if($service->content)
          <div style="font-size:0.85rem;color:#0B132B;line-height:1.9">{!! $service->content !!}</div>
          @endif
        </div>
      </div>
      @empty
      <div style="padding:5rem 0;text-align:center">
        <p style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;color:#8B90A0">Services coming soon</p>
      </div>
      @endforelse
    </div>

    <div style="margin-top:5rem;padding:4rem;background:#0B132B;text-align:center" data-animate>
      <p class="section-tag" style="color:#5E6472;margin-bottom:1rem">Ready to Start?</p>
      <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2rem,4vw,3rem);color:#fff;font-weight:400;margin-bottom:2rem">Let's discuss your project</h2>
      <a href="{{ route('inquiries.create') }}" class="btn-navy" style="border-color:#fff">Get in Touch</a>
    </div>
  </div>
</div>
@endsection
