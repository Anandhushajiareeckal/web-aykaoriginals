@extends('model.layouts.app')
@section('title', 'Highlight Works')
@section('content')
<style>
@media(max-width:900px){
  .works-header-row{flex-direction:column;align-items:flex-start !important;gap:.75rem}
  .works-header-row .btn{width:100%;justify-content:center}
  .works-create-grid{grid-template-columns:1fr !important}
  .work-card-grid{grid-template-columns:1fr !important}
  .work-content-pad{padding:1.25rem !important}
  .work-actions-row{flex-direction:column;gap:.5rem !important}
  .work-actions-row .btn{width:100%;justify-content:center}
  .edit-save-row{flex-direction:column !important}
  .edit-save-row .btn{width:100%;justify-content:center}
}
</style>
<div x-data="{ openCreate: false }">
    <div class="works-header-row" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
        <div>
            <h1 style="font-family:'Cormorant Garamond',serif;font-size:2rem;color:var(--navy)">Highlight Works</h1>
            <p style="font-size:.82rem;color:var(--slate2)">Feature your top 3 projects with detailed descriptions and multiple images.</p>
        </div>
        @if($works->count() < 3)
        <button @click="openCreate = !openCreate" class="btn btn-primary">
            <svg style="width:.875rem;height:.875rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add New Work
        </button>
        @endif
    </div>

    {{-- Create Form --}}
    <div x-show="openCreate" x-transition class="panel" style="margin-bottom:2rem; border:2px solid var(--accent)">
        <div class="panel-header">
            <span class="panel-title">Add Highlight Work ({{ $works->count() + 1 }}/3)</span>
        </div>
        <div class="panel-body">
            <form action="{{ route('model.works.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="works-create-grid" style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
                    <div>
                        <div class="form-group">
                            <label class="form-label">Project Title *</label>
                            <input type="text" name="title" required class="form-control" placeholder="e.g. Vogue Editorial, Chanel SS24">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description / Role</label>
                            <textarea name="description" rows="4" class="form-control" placeholder="Describe your role or the project context..."></textarea>
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Project Images (2-3 recommended) *</label>
                        <div style="border:2px dashed var(--border);border-radius:12px;padding:2rem;text-align:center;background:var(--off);position:relative">
                            <svg style="width:2rem;height:2rem;color:var(--slate2);margin:0 auto .75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p style="font-size:.75rem;color:var(--slate);font-weight:600">Click to upload images</p>
                            <input type="file" name="images[]" multiple required accept="image/*" style="position:absolute;inset:0;opacity:0;cursor:pointer">
                        </div>
                        <p style="font-size:.65rem;color:var(--slate2);margin-top:.5rem">You can select up to 3 images for this specific work.</p>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;gap:1rem;margin-top:1.5rem">
                    <button type="button" @click="openCreate = false" class="btn btn-outline">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Work</button>
                </div>
            </form>
        </div>
    </div>

    {{-- List --}}
    <div style="display:grid;grid-template-columns:1fr;gap:2rem">
        @forelse($works as $work)
        <div class="panel" style="overflow:hidden" x-data="{ editing: false }">
            <div class="work-card-grid" style="display:grid;grid-template-columns:350px 1fr;gap:0">
                {{-- Images Grid --}}
                <div style="background:#0a0e14;padding:1.5rem">
                    <div style="display:grid;grid-template-columns:repeat(3, 1fr);gap:0.5rem">
                        @foreach($work->getMedia('images') as $media)
                        <div style="position:relative;aspect-ratio:3/4;border-radius:6px;overflow:hidden;background:#1a202c">
                            <img src="{{ $media->getUrl('thumb') }}" style="width:100%;height:100%;object-fit:cover">
                            <form action="{{ route('model.works.image.delete', [$work->id, $media->id]) }}" method="POST" style="position:absolute;top:5px;right:5px">
                                @csrf @method('DELETE')
                                <button type="submit" style="background:rgba(239,68,68,.9);border:none;width:18px;height:18px;border-radius:4px;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:.65rem">✕</button>
                            </form>
                        </div>
                        @endforeach
                        @if($work->getMedia('images')->count() < 3)
                        <div style="aspect-ratio:3/4;border:1px dashed rgba(255,255,255,0.1);border-radius:6px;display:flex;align-items:center;justify-content:center">
                            <form action="{{ route('model.works.update', $work->id) }}" method="POST" enctype="multipart/form-data" id="add-img-{{ $work->id }}">
                                @csrf @method('PUT')
                                <input type="hidden" name="title" value="{{ $work->title }}">
                                <label style="cursor:pointer;text-align:center">
                                    <span style="font-size:1.5rem;color:rgba(255,255,255,0.2)">+</span>
                                    <input type="file" name="new_images[]" multiple onchange="this.form.submit()" style="display:none">
                                </label>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Content / Edit Form --}}
                <div class="work-content-pad" style="padding:2.5rem; background:#fff; position:relative">
                    {{-- View Mode --}}
                    <div x-show="!editing">
                        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1.5rem">
                            <div>
                                <span style="font-size:0.6rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--accent);margin-bottom:0.5rem;display:block">Highlight 0{{ $loop->iteration }}</span>
                                <h3 style="font-family:'Cormorant Garamond',serif;font-size:2rem;color:var(--navy);margin:0">{{ $work->title }}</h3>
                            </div>
                            <div class="work-actions-row" style="display:flex;gap:0.75rem">
                                <button @click="editing = true" class="btn btn-outline btn-sm">Edit Details</button>
                                <form action="{{ route('model.works.destroy', $work->id) }}" method="POST" onsubmit="return confirm('Delete this highlight work?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-sm" style="color:var(--red);border-color:var(--red)">Delete</button>
                                </form>
                            </div>
                        </div>
                        <p style="color:var(--slate);line-height:1.8;font-size:.95rem;max-width:600px">{{ $work->description }}</p>
                    </div>

                    {{-- Edit Mode --}}
                    <div x-show="editing" x-cloak>
                        <form action="{{ route('model.works.update', $work->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label class="form-label">Project Title</label>
                                <input type="text" name="title" value="{{ $work->title }}" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description / Role</label>
                                <textarea name="description" rows="5" class="form-control">{{ $work->description }}</textarea>
                            </div>
                            <div class="edit-save-row" style="display:flex;justify-content:flex-end;gap:1rem;margin-top:2rem">
                                <button type="button" @click="editing = false" class="btn btn-outline">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update Work</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="panel" style="padding:5rem;text-align:center">
            <div style="font-size:3rem;margin-bottom:1rem">✨</div>
            <h2 style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;color:var(--navy)">No highlights yet</h2>
            <p style="color:var(--slate2);margin-bottom:1.5rem">Select your best 3 projects to showcase on your premium portfolio.</p>
            <button @click="openCreate = true" class="btn btn-primary">Create First Highlight</button>
        </div>
        @endforelse
    </div>
</div>

@endsection
