@extends('admin.layouts.app')
@section('title','Inquiries')
@section('content')
<div class="flex gap-2 mb-6">
  @foreach([null=>'All','new'=>'New','read'=>'Read','replied'=>'Replied'] as $s => $l)
  <a href="{{ route('admin.inquiries.index', $s ? ['status'=>$s] : []) }}"
     style="padding:0.4rem 1rem;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;border:1px solid {{ $status===$s ? '#0B132B' : '#E2E4EA' }};background:{{ $status===$s ? '#0B132B' : 'transparent' }};color:{{ $status===$s ? '#fff' : '#5E6472' }}">{{ $l }}</a>
  @endforeach
</div>
<div class="admin-card" style="padding:0;overflow:hidden">
  <table style="width:100%;border-collapse:collapse">
    <thead style="background:#F8F8FA"><tr>
      @foreach(['Name','Email','Type','Status','Date','Actions'] as $h)
      <th style="padding:0.75rem 1rem;text-align:left;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;font-weight:500">{{ $h }}</th>
      @endforeach
    </tr></thead>
    <tbody>
      @forelse($inquiries as $inq)
      <tr style="border-top:1px solid #E2E4EA;{{ $inq->status==='new' ? 'background:#fdfcff' : '' }}">
        <td style="padding:0.75rem 1rem;font-size:0.85rem;font-weight:{{ $inq->status==='new' ? '600' : '400' }};color:#0B132B">{{ $inq->name }}</td>
        <td style="padding:0.75rem 1rem;font-size:0.8rem;color:#5E6472">{{ $inq->email }}</td>
        <td style="padding:0.75rem 1rem;font-size:0.75rem;color:#5E6472">{{ str_replace('_',' ',ucfirst($inq->type)) }}</td>
        <td style="padding:0.75rem 1rem"><span class="{{ $inq->status==='new' ? 'badge-active' : 'badge-inactive' }}">{{ $inq->status }}</span></td>
        <td style="padding:0.75rem 1rem;font-size:0.75rem;color:#5E6472">{{ $inq->created_at->format('M d, Y') }}</td>
        <td style="padding:0.75rem 1rem"><a href="{{ route('admin.inquiries.show',$inq) }}" class="admin-btn-ghost" style="padding:0.3rem 0.75rem;font-size:0.65rem">View</a></td>
      </tr>
      @empty
      <tr><td colspan="6" style="padding:2rem;text-align:center;color:#5E6472">No inquiries yet.</td></tr>
      @endforelse
    </tbody>
  </table>
  @if($inquiries->hasPages())<div style="padding:1rem;border-top:1px solid #E2E4EA">{{ $inquiries->links() }}</div>@endif
</div>
@endsection
