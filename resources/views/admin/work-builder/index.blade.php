@extends('admin.layouts.app')
@section('title', 'Work Page Builder')
@section('content')

<div class="flex items-center justify-between mb-8">
    <div>
        <h1 style="font-size:1.5rem;font-weight:600;color:#0B132B">Work Page Builder</h1>
        <p style="font-size:0.875rem;color:#5E6472;margin-top:0.25rem">Customize the content and hero sections on the Production / Work page.</p>
    </div>
    <a href="{{ route('projects.index') }}" target="_blank" class="admin-btn-ghost flex items-center gap-2">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        View Live Page
    </a>
</div>

<div class="grid grid-cols-1 gap-8 max-w-4xl">

    {{-- HERO SECTION --}}
    <div class="admin-card">
        <div class="flex items-center gap-3 mb-6">
            <div style="width:12px;height:12px;border-radius:50%;background:#6C63FF"></div>
            <h2 style="font-size:1.1rem;font-weight:600;color:#0B132B">Hero Section</h2>
            <span style="margin-left:auto;font-size:0.7rem;color:#8B90A0;text-transform:uppercase;letter-spacing:0.1em">Shown at top</span>
        </div>

        <form action="{{ route('admin.work-builder.update', 'hero') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label style="display:block;font-size:0.7rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#5E6472;margin-bottom:0.5rem">Headline</label>
                <input type="text" name="heading" value="{{ optional($sections->get('hero'))->heading ?? 'Production in Motion.' }}" class="admin-input">
                <p style="font-size:0.7rem;color:#8B90A0;margin-top:0.35rem">Suggested text. Use &lt;em&gt;&lt;/em&gt; to style italic portions.</p>
            </div>
            
            <div class="mb-4">
                <label style="display:block;font-size:0.7rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#5E6472;margin-bottom:0.5rem">Subheadline / Body</label>
                <textarea name="body" class="admin-input" rows="3">{{ optional($sections->get('hero'))->body ?? 'From concept to campaign — we bring luxury brands to life through cinematic production, editorial photography, and immersive creative direction.' }}</textarea>
            </div>
            
            <button type="submit" class="admin-btn bg-emerald-600 hover:bg-emerald-700">Save Hero Section</button>
        </form>
    </div>

    {{-- CTA SECTION --}}
    <div class="admin-card">
        <div class="flex items-center gap-3 mb-6">
            <div style="width:12px;height:12px;border-radius:50%;background:#F59E0B"></div>
            <h2 style="font-size:1.1rem;font-weight:600;color:#0B132B">CTA Section</h2>
            <span style="margin-left:auto;font-size:0.7rem;color:#8B90A0;text-transform:uppercase;letter-spacing:0.1em">Shown at bottom</span>
        </div>

        <form action="{{ route('admin.work-builder.update', 'cta') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label style="display:block;font-size:0.7rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#5E6472;margin-bottom:0.5rem">Small Tagline</label>
                <input type="text" name="subheading" value="{{ optional($sections->get('cta'))->subheading ?? 'Work With Us' }}" class="admin-input">
            </div>

            <div class="mb-4">
                <label style="display:block;font-size:0.7rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#5E6472;margin-bottom:0.5rem">Main Headline</label>
                <input type="text" name="heading" value="{{ optional($sections->get('cta'))->heading ?? 'Have a project<br><em style=\"opacity:.7\">in mind?</em>' }}" class="admin-input">
            </div>

            <div class="mb-4">
                <label style="display:block;font-size:0.7rem;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#5E6472;margin-bottom:0.5rem">Body Text</label>
                <textarea name="body" class="admin-input" rows="2">{{ optional($sections->get('cta'))->body ?? 'We\'d love to collaborate. Let\'s create something extraordinary together.' }}</textarea>
            </div>
            
            <button type="submit" class="admin-btn bg-emerald-600 hover:bg-emerald-700">Save CTA Section</button>
        </form>
    </div>
</div>
@endsection
