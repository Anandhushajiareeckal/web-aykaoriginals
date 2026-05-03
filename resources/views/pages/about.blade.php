@extends('layouts.app')
@section('title', $page->meta_title ?? 'About AYKA Originals')
@section('description', $page->meta_description ?? 'About AYKA Originals — premier talent management agency.')
@section('content')
<div style="padding-top:7rem">
  <div style="padding:5rem 1.5rem;max-width:1280px;margin:0 auto" class="px-6 lg:px-16">
    <div style="display:grid;grid-template-columns:1fr;gap:5rem;margin-bottom:5rem" class="lg:grid-cols-2">
      <div data-animate>
        <p class="section-tag" style="margin-bottom:1rem">The Agency</p>
        <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,5vw,4rem);color:#0B132B;font-weight:400;line-height:1.1;margin-bottom:2rem">{{ $page->title }}</h1>
        <div style="font-size:0.9rem;color:#5E6472;line-height:2" class="prose max-w-none">{!! $page->content !!}</div>
      </div>
      <div style="background:#F8F8FA;padding:3rem;display:flex;flex-direction:column;justify-content:center" data-animate>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem">
          @foreach([[\App\Models\Talent::active()->count().'+','Represented Talents'],[\App\Models\Project::active()->count().'+','Campaigns'],['2024','Est.'],['12+','Countries']] as $s)
          <div style="text-align:center">
            <p style="font-family:'Cormorant Garamond',serif;font-size:2.5rem;color:#0B132B;font-weight:400">{{ $s[0] }}</p>
            <p class="section-tag" style="margin-top:0.25rem">{{ $s[1] }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div style="background:#0B132B;padding:5rem 1.5rem;text-align:center" class="px-6">
    <p class="section-tag" style="color:#5E6472;margin-bottom:1.5rem">Work With Us</p>
    <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2rem,4vw,3rem);color:#fff;font-weight:400;margin-bottom:2rem">Ready to Collaborate?</h2>
    <a href="{{ route('inquiries.create') }}" class="btn-navy" style="border-color:#fff">Get in Touch</a>
  </div>
</div>
@endsection
