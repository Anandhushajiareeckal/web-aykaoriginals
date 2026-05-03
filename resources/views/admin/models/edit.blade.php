@extends('admin.layouts.app')
@section('title','Edit Model Profile')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
  <div>
    <h1 style="font-family:'Cormorant Garamond',serif;font-size:2rem;color:var(--navy)">Edit Model: {{ $talent->name }}</h1>
    <p style="font-size:.82rem;color:var(--slate2)">Update profile details for this model</p>
  </div>
  <a href="{{ route('admin.models.index') }}" class="btn btn-outline">Back to Models</a>
</div>

<div class="panel">
  <div class="panel-body">
    <form action="{{ route('admin.models.update', $talent) }}" method="POST">
      @csrf @method('PUT')
      
      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));gap:1.5rem">
        <div class="form-group">
          <label class="form-label">Full Name</label>
          <input type="text" name="name" value="{{ old('name', $talent->name) }}" required class="form-control">
          @error('name')<p style="color:var(--red);font-size:.72rem">{{ $message }}</p>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Username / Slug</label>
          <input type="text" name="slug" value="{{ old('slug', $talent->slug) }}" required class="form-control">
          @error('slug')<p style="color:var(--red);font-size:.72rem">{{ $message }}</p>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Category</label>
          <input type="text" name="category" value="{{ old('category', $talent->category) }}" class="form-control">
        </div>
        <div class="form-group">
          <label class="form-label">Gender</label>
          <select name="gender" class="form-control">
            <option value="">Select gender</option>
            @foreach(['female'=>'Female','male'=>'Male','non-binary'=>'Non-Binary','other'=>'Other'] as $v=>$l)
            <option value="{{ $v }}" {{ old('gender',$talent->gender)===$v?'selected':'' }}>{{ $l }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Location</label>
          <input type="text" name="location" value="{{ old('location', $talent->location) }}" class="form-control">
        </div>
      </div>

      <div class="form-group" style="margin-top:1.5rem">
        <label class="form-label">Bio</label>
        <textarea name="bio" rows="4" class="form-control">{{ old('bio', $talent->bio) }}</textarea>
      </div>

      <h3 style="font-size:1.1rem;font-weight:600;color:var(--navy);margin:2rem 0 1rem;padding-bottom:.5rem;border-bottom:1px solid var(--border)">Measurements</h3>
      
      <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:1.5rem">
        @foreach([
          ['Height','height'],
          ['Chest / Bust','chest_bust'],
          ['Waist','waist'],
          ['Hips','hips'],
          ['Weight','weight'],
          ['Inseam','inseam'],
          ['Shoe Size','shoe_size'],
          ['Eye Color','eye_color'],
          ['Hair Color','hair_color']
        ] as [$label,$name])
        <div class="form-group">
          <label class="form-label">{{ $label }}</label>
          <input type="text" name="{{ $name }}" value="{{ old($name, $talent->$name) }}" class="form-control">
        </div>
        @endforeach
      </div>

      <div style="margin-top:2rem;text-align:right">
        <button type="submit" class="btn btn-primary">Update Profile</button>
      </div>
    </form>
  </div>
</div>

@endsection
