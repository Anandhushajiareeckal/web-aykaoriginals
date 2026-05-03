@extends('admin.layouts.app')
@section('title','Inquiry from ' . $inquiry->name)
@section('content')
<div style="max-width:700px">
  <div class="admin-card mb-4">
    <div class="grid grid-cols-2 gap-4 mb-4">
      @foreach([['Name',$inquiry->name],['Email',$inquiry->email],['Company',$inquiry->company??'—'],['Type',str_replace('_',' ',ucfirst($inquiry->type))],['Budget',$inquiry->budget??'—'],['Date',$inquiry->created_at->format('M d, Y H:i')]] as [$l,$v])
      <div>
        <p class="stat-label" style="margin-bottom:0.25rem">{{ $l }}</p>
        <p style="font-size:0.9rem;color:#0B132B">{{ $v }}</p>
      </div>
      @endforeach
    </div>
    <div style="border-top:1px solid #E2E4EA;padding-top:1rem">
      <p class="stat-label" style="margin-bottom:0.5rem">Message</p>
      <p style="font-size:0.9rem;color:#0B132B;line-height:1.7">{{ $inquiry->message }}</p>
    </div>
  </div>
  <div class="admin-card mb-4">
    <form method="POST" action="{{ route('admin.inquiries.update',$inquiry) }}" class="flex items-center gap-3">
      @csrf @method('PUT')
      <label style="font-size:0.7rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472">Status:</label>
      <select name="status" class="admin-select" style="width:auto">
        @foreach(['new','read','replied','archived'] as $s)
        <option value="{{ $s }}" {{ $inquiry->status===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
        @endforeach
      </select>
      <button type="submit" class="admin-btn">Update</button>
    </form>
  </div>
  <div class="flex gap-3">
    <a href="{{ route('admin.inquiries.index') }}" class="admin-btn-ghost">Back to Inquiries</a>
    <a href="mailto:{{ $inquiry->email }}?subject=Re: {{ urlencode($inquiry->type) }}" class="admin-btn">Reply via Email</a>
    <form method="POST" action="{{ route('admin.inquiries.destroy',$inquiry) }}" style="margin-left:auto" onsubmit="return confirm('Delete?')">
      @csrf @method('DELETE')
      <button type="submit" class="admin-btn-danger">Delete</button>
    </form>
  </div>
</div>
@endsection
