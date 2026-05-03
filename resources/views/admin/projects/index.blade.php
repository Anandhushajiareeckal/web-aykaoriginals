@extends('admin.layouts.app')
@section('title','Projects')
@section('content')
<div class="flex items-center justify-between mb-6"><div></div><a href="{{ route('admin.projects.create') }}" class="admin-btn">+ Add Project</a></div>
<div class="admin-card" style="padding:0;overflow:hidden">
  <table style="width:100%;border-collapse:collapse">
    <thead style="background:#F8F8FA"><tr>
      @foreach(['Brand','Year','Service','Status','Featured','Actions'] as $h)
      <th style="padding:0.75rem 1rem;text-align:left;font-size:0.65rem;letter-spacing:0.15em;text-transform:uppercase;color:#5E6472;font-weight:500">{{ $h }}</th>
      @endforeach
    </tr></thead>
    <tbody>
      @forelse($projects as $project)
      <tr style="border-top:1px solid #E2E4EA">
        <td style="padding:0.75rem 1rem;font-size:0.85rem;font-weight:500;color:#0B132B">{{ $project->brand }}</td>
        <td style="padding:0.75rem 1rem;font-size:0.8rem;color:#5E6472">{{ $project->year }}</td>
        <td style="padding:0.75rem 1rem;font-size:0.8rem;color:#5E6472">{{ $project->service_type }}</td>
        <td style="padding:0.75rem 1rem"><span class="{{ $project->is_active?'badge-active':'badge-inactive' }}">{{ $project->is_active?'Active':'Inactive' }}</span></td>
        <td style="padding:0.75rem 1rem"><span class="{{ $project->is_featured?'badge-active':'badge-inactive' }}">{{ $project->is_featured?'Yes':'No' }}</span></td>
        <td style="padding:0.75rem 1rem"><a href="{{ route('admin.projects.edit',$project) }}" class="admin-btn-ghost" style="padding:0.3rem 0.75rem;font-size:0.65rem">Edit</a></td>
      </tr>
      @empty
      <tr><td colspan="6" style="padding:2rem;text-align:center;color:#5E6472">No projects yet.</td></tr>
      @endforelse
    </tbody>
  </table>
  @if($projects->hasPages())<div style="padding:1rem;border-top:1px solid #E2E4EA">{{ $projects->links() }}</div>@endif
</div>
@endsection
