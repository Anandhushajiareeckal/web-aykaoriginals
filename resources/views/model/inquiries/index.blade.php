@extends('model.layouts.app')
@section('title', 'Inquiries')
@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
  <div>
    <h1 style="font-family:'Cormorant Garamond',serif;font-size:2rem;color:var(--navy)">Booking Inquiries</h1>
    <p style="font-size:.82rem;color:var(--slate2)">Messages from clients interested in booking you.</p>
  </div>
  <div style="text-align:right">
    <span class="badge badge-purple" style="font-size:.75rem">Total Inquiries Received: {{ $allCount }}</span>
    <p style="font-size:.65rem;color:var(--slate2);margin-top:.2rem">Showing only admin-approved inquiries</p>
  </div>
</div>

<div class="panel">
  <div style="overflow-x:auto">
    <table class="data-table">
      <thead>
        <tr>
          <th>From</th>
          <th>Message Preview</th>
          <th>Received</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($approvedInquiries as $inquiry)
        <tr>
          <td>
            <div style="display:flex;align-items:center;gap:.75rem">
              <div style="width:36px;height:36px;border-radius:8px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <span style="font-size:.8rem;font-weight:700;color:#fff">{{ strtoupper(substr($inquiry->name,0,1)) }}</span>
              </div>
              <div>
                <div style="font-weight:600;font-size:.88rem;color:var(--navy)">{{ $inquiry->name }}</div>
                <div style="font-size:.7rem;color:var(--slate2)">{{ $inquiry->email }}</div>
              </div>
            </div>
          </td>
          <td style="max-width:300px">
            <p style="font-size:.8rem;color:var(--navy);line-height:1.5;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical">{{ $inquiry->message }}</p>
          </td>
          <td style="font-size:.72rem;color:var(--slate2);white-space:nowrap">{{ $inquiry->created_at->diffForHumans() }}</td>
          <td>
            <a href="{{ route('model.inquiries.show', $inquiry) }}" class="btn btn-outline btn-sm">View Details</a>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" style="text-align:center;padding:4rem 2rem">
            <div style="font-size:2.5rem;margin-bottom:.75rem">📭</div>
            <p style="font-weight:600;color:var(--navy);margin-bottom:.35rem">No approved inquiries yet</p>
            <p style="font-size:.8rem;color:var(--slate2);max-width:340px;margin:0 auto">When clients contact you through your public profile, AYKA management will review and approve inquiries before they appear here.</p>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($approvedInquiries->hasPages())
  <div style="padding:1rem 1.25rem;border-top:1px solid var(--border)">{{ $approvedInquiries->links() }}</div>
  @endif
</div>

@endsection
