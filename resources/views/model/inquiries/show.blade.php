@extends('model.layouts.app')
@section('title', 'Inquiry Details')
@section('content')

<div style="margin-bottom:1.5rem">
  <a href="{{ route('model.inquiries.index') }}" class="btn btn-outline btn-sm">← Back to Inquiries</a>
</div>

<div class="panel">
  <div class="panel-header">
    <span class="panel-title">Booking Inquiry Details</span>
    <span class="badge badge-green">✓ Approved by Admin</span>
  </div>
  <div class="panel-body">
    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(200px, 1fr));gap:2rem;margin-bottom:2rem;padding-bottom:2rem;border-bottom:1px solid var(--border)">
      <div>
        <p style="font-size:.65rem;letter-spacing:.1em;text-transform:uppercase;color:var(--slate2);margin-bottom:.5rem">Sender</p>
        <p style="font-weight:600;color:var(--navy);font-size:1.1rem">{{ $inquiry->name }}</p>
      </div>
      <div>
        <p style="font-size:.65rem;letter-spacing:.1em;text-transform:uppercase;color:var(--slate2);margin-bottom:.5rem">Email</p>
        <p style="color:var(--navy)"><a href="mailto:{{ $inquiry->email }}" style="color:var(--accent);text-decoration:none">{{ $inquiry->email }}</a></p>
      </div>
      <div>
        <p style="font-size:.65rem;letter-spacing:.1em;text-transform:uppercase;color:var(--slate2);margin-bottom:.5rem">Company</p>
        <p style="color:var(--navy)">{{ $inquiry->company ?: '—' }}</p>
      </div>
      <div>
        <p style="font-size:.65rem;letter-spacing:.1em;text-transform:uppercase;color:var(--slate2);margin-bottom:.5rem">Received</p>
        <p style="color:var(--navy)">{{ $inquiry->created_at->format('M d, Y h:i A') }}</p>
      </div>
    </div>
    
    <div>
      <p style="font-size:.65rem;letter-spacing:.1em;text-transform:uppercase;color:var(--slate2);margin-bottom:.75rem">Message Content</p>
      <div style="background:var(--off);padding:1.5rem;border-radius:12px;border:1px solid var(--border);color:var(--navy);line-height:1.7;font-size:.95rem;white-space:pre-wrap">{{ $inquiry->message }}</div>
    </div>
  </div>
</div>

@endsection
