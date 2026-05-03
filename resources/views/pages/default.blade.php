@extends('layouts.app')
@section('title', $page->meta_title ?? $page->title)
@section('description', $page->meta_description ?? '')
@section('content')
<div style="padding-top:7rem;padding-bottom:5rem" class="px-6 lg:px-16">
  <div style="max-width:860px;margin:0 auto">
    <div style="margin-bottom:3rem" data-animate>
      <h1 style="font-family:'Cormorant Garamond',serif;font-size:clamp(2.5rem,5vw,4rem);color:#0B132B;font-weight:400;line-height:1.1">{{ $page->title }}</h1>
    </div>
    <div style="font-size:0.9rem;color:#0B132B;line-height:2;border-top:1px solid #E2E4EA;padding-top:2.5rem" class="prose max-w-none">
      {!! $page->content !!}
    </div>
  </div>
</div>
@endsection
