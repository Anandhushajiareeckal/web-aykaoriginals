@extends('admin.layouts.app')
@section('title','Dashboard')

@section('content')

{{-- ── KPI STAT CARDS ── --}}
<div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1rem;margin-bottom:1.5rem" class="sm:grid-cols-2 lg:grid-cols-4">

  <div class="stat-card" style="border-top:3px solid #6C63FF">
    <div class="stat-card-icon" style="background:#6C63FF18">
      <svg style="width:1.25rem;height:1.25rem;color:#6C63FF" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
    </div>
    <div class="stat-card-value">{{ number_format($totalViews30) }}</div>
    <div class="stat-card-label">Total Views (30d)</div>
    <div class="stat-card-change {{ $viewsGrowth >= 0 ? 'up' : 'down' }}">
      <svg style="width:.75rem;height:.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $viewsGrowth >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6' }}"/></svg>
      {{ abs($viewsGrowth) }}% vs last 30d
    </div>
    <div class="stat-card-bg">👁</div>
  </div>

  <div class="stat-card" style="border-top:3px solid #EF4444">
    <div class="stat-card-icon" style="background:#EF444418">
      <svg style="width:1.25rem;height:1.25rem;color:#EF4444" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
    </div>
    <div class="stat-card-value">{{ $newInquiries }}</div>
    <div class="stat-card-label">New Inquiries</div>
    <div class="stat-card-change down">
      <svg style="width:.75rem;height:.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      {{ $inquiryCount }} total — need response
    </div>
    <div class="stat-card-bg">✉️</div>
  </div>

  <div class="stat-card" style="border-top:3px solid #22C55E">
    <div class="stat-card-icon" style="background:#22C55E18">
      <svg style="width:1.25rem;height:1.25rem;color:#22C55E" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
    </div>
    <div class="stat-card-value">{{ $talentCount }}</div>
    <div class="stat-card-label">Talent Profiles</div>
    <div class="stat-card-change up">
      <svg style="width:.75rem;height:.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
      Active roster
    </div>
    <div class="stat-card-bg">👤</div>
  </div>

  <div class="stat-card" style="border-top:3px solid #F59E0B">
    <div class="stat-card-icon" style="background:#F59E0B18">
      <svg style="width:1.25rem;height:1.25rem;color:#F59E0B" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
    </div>
    <div class="stat-card-value">{{ $thisWeek }}</div>
    <div class="stat-card-label">Views This Week</div>
    <div class="stat-card-change {{ $thisWeek >= $lastWeek ? 'up' : 'down' }}">
      <svg style="width:.75rem;height:.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $thisWeek >= $lastWeek ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6' }}"/></svg>
      vs {{ $lastWeek }} last week
    </div>
    <div class="stat-card-bg">📅</div>
  </div>
</div>

{{-- ── MAIN CHART: Views + Inquiries Over Time ── --}}
<div class="panel" style="margin-bottom:1.5rem">
  <div class="panel-header" style="flex-wrap:wrap;gap:.75rem">
    <div>
      <span class="panel-title">Traffic & Inquiries Overview</span>
      <p style="font-size:.72rem;color:#8B90A0;margin-top:.2rem">Daily page views and booking inquiries</p>
    </div>
    <div style="display:flex;align-items:center;gap:.5rem">
      <div style="display:flex;align-items:center;gap:.3rem;font-size:.7rem;color:#5E6472">
        <span style="width:10px;height:10px;border-radius:2px;background:#6C63FF;display:inline-block"></span>Page Views
      </div>
      <div style="display:flex;align-items:center;gap:.3rem;font-size:.7rem;color:#5E6472">
        <span style="width:10px;height:10px;border-radius:2px;background:#EF4444;display:inline-block"></span>Inquiries
      </div>
      <div style="display:flex;gap:.25rem;margin-left:.5rem">
        @foreach([7,14,30] as $r)
        <button onclick="loadChart({{ $r }})" id="range-{{ $r }}"
          style="padding:.3rem .7rem;font-size:.65rem;border-radius:6px;border:1px solid #E4E6F0;cursor:pointer;font-weight:500;transition:all .2s"
          class="range-btn">{{ $r }}d</button>
        @endforeach
      </div>
    </div>
  </div>
  <div style="padding:1.25rem">
    <canvas id="mainChart" style="width:100%;max-height:300px"></canvas>
  </div>
</div>

{{-- ── ROW 2: Hourly + Device ── --}}
<div style="display:grid;grid-template-columns:1fr;gap:1.5rem;margin-bottom:1.5rem" class="lg:grid-cols-2">

  {{-- Hourly Activity Today --}}
  <div class="panel">
    <div class="panel-header">
      <div>
        <span class="panel-title">Hourly Activity Today</span>
        <p style="font-size:.72rem;color:#8B90A0;margin-top:.2rem">Page views per hour (00:00 — 23:00)</p>
      </div>
    </div>
    <div style="padding:1.25rem">
      <canvas id="hourlyChart" style="width:100%;max-height:220px"></canvas>
    </div>
  </div>

  {{-- Device + Browser --}}
  <div class="panel">
    <div class="panel-header">
      <span class="panel-title">Device & Browser Breakdown</span>
    </div>
    <div style="padding:1.25rem;display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
      <div>
        <p style="font-size:.72rem;font-weight:600;color:#5E6472;margin-bottom:.875rem;letter-spacing:.05em">BY DEVICE</p>
        <canvas id="deviceChart" style="max-width:180px;margin:0 auto;display:block"></canvas>
        <div style="margin-top:.875rem;display:flex;flex-direction:column;gap:.4rem">
          @php
            $devTotal = collect($deviceStats)->sum();
            $devColors = ['desktop'=>'#6C63FF','mobile'=>'#06B6D4','tablet'=>'#F59E0B'];
          @endphp
          @foreach($deviceStats as $device => $count)
          <div style="display:flex;align-items:center;justify-content:space-between">
            <div style="display:flex;align-items:center;gap:.4rem">
              <span style="width:8px;height:8px;border-radius:2px;background:{{ $devColors[$device] ?? '#8B90A0' }};display:inline-block;flex-shrink:0"></span>
              <span style="font-size:.72rem;color:#5E6472;text-transform:capitalize">{{ $device }}</span>
            </div>
            <span style="font-size:.72rem;font-weight:600;color:#0B132B">{{ $devTotal > 0 ? round(($count/$devTotal)*100) : 0 }}%</span>
          </div>
          @endforeach
        </div>
      </div>
      <div>
        <p style="font-size:.72rem;font-weight:600;color:#5E6472;margin-bottom:.875rem;letter-spacing:.05em">BY BROWSER</p>
        <div style="display:flex;flex-direction:column;gap:.625rem">
          @php $browserTotal = $browserStats->sum('count'); @endphp
          @foreach($browserStats as $b)
          @php $pct = $browserTotal > 0 ? round(($b->count/$browserTotal)*100) : 0; @endphp
          <div>
            <div style="display:flex;justify-content:space-between;margin-bottom:.25rem">
              <span style="font-size:.72rem;color:#5E6472">{{ $b->browser }}</span>
              <span style="font-size:.72rem;font-weight:600;color:#0B132B">{{ $pct }}%</span>
            </div>
            <div style="height:5px;background:#E4E6F0;border-radius:999px;overflow:hidden">
              <div style="height:100%;width:{{ $pct }}%;background:{{ ['Chrome'=>'#6C63FF','Firefox'=>'#F59E0B','Safari'=>'#22C55E','Edge'=>'#06B6D4'][$b->browser] ?? '#8B90A0' }};border-radius:999px;transition:width .6s ease"></div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ── ROW 3: Content Views + Inquiry Types ── --}}
<div style="display:grid;grid-template-columns:1fr;gap:1.5rem;margin-bottom:1.5rem" class="lg:grid-cols-3">

  {{-- Content Views Donut --}}
  <div class="panel">
    <div class="panel-header">
      <div>
        <span class="panel-title">Content Views</span>
        <p style="font-size:.72rem;color:#8B90A0;margin-top:.2rem">Last 30 days by section</p>
      </div>
    </div>
    <div style="padding:1.25rem">
      <canvas id="contentChart" style="max-width:200px;margin:0 auto;display:block;max-height:200px"></canvas>
      <div style="margin-top:1rem;display:flex;flex-direction:column;gap:.5rem">
        @php
          $contentData = [['Home',$homeViews,'#0B132B'],['Talent',$talentViews,'#6C63FF'],['Work',$workViews,'#06B6D4'],['Blog',$blogViews,'#22C55E']];
          $contentTotal = $homeViews + $talentViews + $workViews + $blogViews;
        @endphp
        @foreach($contentData as $c)
        <div style="display:flex;align-items:center;justify-content:space-between">
          <div style="display:flex;align-items:center;gap:.4rem">
            <span style="width:8px;height:8px;border-radius:2px;background:{{ $c[2] }};display:inline-block"></span>
            <span style="font-size:.75rem;color:#5E6472">{{ $c[0] }}</span>
          </div>
          <div style="display:flex;align-items:center;gap:.5rem">
            <span style="font-size:.72rem;color:#8B90A0">{{ number_format($c[1]) }}</span>
            <span style="font-size:.7rem;font-weight:600;color:#0B132B;min-width:30px;text-align:right">{{ $contentTotal > 0 ? round(($c[1]/$contentTotal)*100) : 0 }}%</span>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- Inquiry Types --}}
  <div class="panel">
    <div class="panel-header">
      <div>
        <span class="panel-title">Inquiry Types</span>
        <p style="font-size:.72rem;color:#8B90A0;margin-top:.2rem">Last 30 days breakdown</p>
      </div>
    </div>
    <div style="padding:1.25rem">
      <canvas id="inquiryTypeChart" style="max-width:200px;margin:0 auto;display:block;max-height:200px"></canvas>
      <div style="margin-top:1rem;display:flex;flex-direction:column;gap:.5rem">
        @php $typeColors = ['talent_booking'=>'#6C63FF','campaign_production'=>'#06B6D4','editorial'=>'#22C55E','lookbook'=>'#F59E0B','other'=>'#8B90A0']; @endphp
        @foreach($inquiryTypes as $t)
        <div style="display:flex;align-items:center;justify-content:space-between">
          <div style="display:flex;align-items:center;gap:.4rem">
            <span style="width:8px;height:8px;border-radius:2px;background:{{ $typeColors[$t->type] ?? '#8B90A0' }};display:inline-block"></span>
            <span style="font-size:.73rem;color:#5E6472">{{ ucwords(str_replace('_',' ',$t->type)) }}</span>
          </div>
          <span style="font-size:.72rem;font-weight:600;color:#0B132B">{{ $t->count }}</span>
        </div>
        @endforeach
        @if($inquiryTypes->isEmpty())
        <p style="font-size:.78rem;color:#8B90A0;text-align:center;padding:1rem 0">No inquiries yet</p>
        @endif
      </div>
    </div>
  </div>

  {{-- Inquiry Status + Quick Actions --}}
  <div class="panel">
    <div class="panel-header">
      <span class="panel-title">Inquiry Status</span>
    </div>
    <div style="padding:1.25rem">
      @php
        $statusMap  = ['new'=>['New','#EF4444'],'read'=>['Read','#F59E0B'],'replied'=>['Replied','#22C55E'],'archived'=>['Archived','#8B90A0']];
        $statusTotal = collect($inquiryStatus)->sum();
      @endphp
      @foreach($statusMap as $key => [$label,$color])
      @php $count = $inquiryStatus[$key] ?? 0; $pct = $statusTotal > 0 ? round(($count/$statusTotal)*100) : 0; @endphp
      <div style="margin-bottom:1rem">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.3rem">
          <div style="display:flex;align-items:center;gap:.4rem">
            <span style="width:8px;height:8px;border-radius:50%;background:{{ $color }};display:inline-block"></span>
            <span style="font-size:.75rem;font-weight:500;color:#0B132B">{{ $label }}</span>
          </div>
          <div style="display:flex;align-items:center;gap:.5rem">
            <span style="font-size:.72rem;color:#8B90A0">{{ $count }}</span>
            <span style="font-size:.7rem;font-weight:600;color:{{ $color }}">{{ $pct }}%</span>
          </div>
        </div>
        <div style="height:6px;background:#E4E6F0;border-radius:999px;overflow:hidden">
          <div style="height:100%;width:{{ $pct }}%;background:{{ $color }};border-radius:999px;transition:width .8s ease"></div>
        </div>
      </div>
      @endforeach
      <div style="margin-top:1.25rem;padding-top:1rem;border-top:1px solid #E4E6F0">
        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-primary btn-sm" style="width:100%;justify-content:center">
          View All Inquiries
        </a>
      </div>
    </div>
  </div>
</div>

{{-- ── ROW 4: Top Pages + Recent Inquiries ── --}}
<div style="display:grid;grid-template-columns:1fr;gap:1.5rem;margin-bottom:1.5rem" class="lg:grid-cols-2">

  {{-- Top Pages --}}
  <div class="panel">
    <div class="panel-header">
      <div>
        <span class="panel-title">Top Pages</span>
        <p style="font-size:.72rem;color:#8B90A0;margin-top:.2rem">Most visited pages last 30 days</p>
      </div>
    </div>
    <div>
      @php $maxViews = $topPages->max('views') ?: 1; @endphp
      @forelse($topPages as $i => $page)
      <div style="display:flex;align-items:center;gap:.875rem;padding:.875rem 1.25rem;border-bottom:1px solid #E4E6F0">
        <span style="width:22px;height:22px;border-radius:6px;background:{{ ['#6C63FF','#06B6D4','#22C55E','#F59E0B','#EF4444','#8B5CF6','#EC4899','#14B8A6'][$i] ?? '#8B90A0' }}18;display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:700;color:{{ ['#6C63FF','#06B6D4','#22C55E','#F59E0B','#EF4444','#8B5CF6','#EC4899','#14B8A6'][$i] ?? '#8B90A0' }};flex-shrink:0">{{ $i+1 }}</span>
        <div style="flex:1;min-width:0">
          <p style="font-size:.8rem;font-weight:500;color:#0B132B;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">/{{ $page->page ?: '(home)' }}</p>
          <div style="height:4px;background:#E4E6F0;border-radius:999px;margin-top:.35rem;overflow:hidden">
            <div style="height:100%;width:{{ round(($page->views/$maxViews)*100) }}%;background:{{ ['#6C63FF','#06B6D4','#22C55E','#F59E0B','#EF4444','#8B5CF6','#EC4899','#14B8A6'][$i] ?? '#8B90A0' }};border-radius:999px"></div>
          </div>
        </div>
        <span style="font-size:.8rem;font-weight:700;color:#0B132B;flex-shrink:0">{{ number_format($page->views) }}</span>
      </div>
      @empty
      <div style="padding:3rem;text-align:center;color:#8B90A0;font-size:.82rem">No page view data yet. Views will appear once people visit your site.</div>
      @endforelse
    </div>
  </div>

  {{-- Recent Inquiries --}}
  <div class="panel">
    <div class="panel-header">
      <span class="panel-title">Recent Inquiries</span>
      <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline btn-sm">View All</a>
    </div>
    <div style="overflow-x:auto">
      <table class="data-table">
        <thead><tr>
          <th>Client</th><th>Type</th><th>Status</th><th>Date</th><th></th>
        </tr></thead>
        <tbody>
          @forelse($recentInquiries as $inq)
          <tr>
            <td>
              <div style="display:flex;align-items:center;gap:.5rem">
                <div class="avatar" style="width:28px;height:28px;font-size:.6rem;border-radius:7px;flex-shrink:0">{{ strtoupper(substr($inq->name,0,2)) }}</div>
                <div>
                  <div style="font-weight:600;font-size:.8rem;color:#0B132B">{{ $inq->name }}</div>
                  <div style="font-size:.68rem;color:#8B90A0">{{ Str::limit($inq->email,20) }}</div>
                </div>
              </div>
            </td>
            <td><span class="tag" style="font-size:.65rem">{{ str_replace('_',' ',ucfirst($inq->type)) }}</span></td>
            <td>
              <span class="badge {{ match($inq->status) { 'new'=>'badge-red','read'=>'badge-amber','replied'=>'badge-green',default=>'badge-slate' } }}">{{ ucfirst($inq->status) }}</span>
            </td>
            <td style="font-size:.72rem;color:#8B90A0;white-space:nowrap">{{ $inq->created_at->diffForHumans() }}</td>
            <td>
              <a href="{{ route('admin.inquiries.show',$inq) }}" class="btn btn-outline btn-sm btn-icon">
                <svg style="width:.8rem;height:.8rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
              </a>
            </td>
          </tr>
          @empty
          <tr><td colspan="5" style="text-align:center;padding:2rem;color:#8B90A0">No inquiries yet</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- ── CONTENT OVERVIEW ── --}}
<div class="panel">
  <div class="panel-header">
    <span class="panel-title">Content & Site Overview</span>
    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline btn-sm">View Site</a>
  </div>
  <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr))">
    @foreach([
      ['Talent Profiles',$talentCount,route('admin.talent.index'),'👤','#6C63FF'],
      ['Projects/Work',$projectCount,route('admin.projects.index'),'📁','#06B6D4'],
      ['Blog Posts',$blogCount,route('admin.blog.index'),'📝','#22C55E'],
      ['Gallery Items',$galleryCount,route('admin.gallery.index'),'🖼️','#F59E0B'],
      ['Services',$serviceCount,route('admin.services.index'),'⚡','#EF4444'],
      ['Inquiries',$inquiryCount,route('admin.inquiries.index'),'✉️','#8B5CF6'],
    ] as $item)
    <a href="{{ $item[2] }}" style="padding:1.25rem;border-right:1px solid #E4E6F0;text-align:center;transition:background .2s;display:block" onmouseover="this.style.background='#F4F5FA'" onmouseout="this.style.background='transparent'">
      <div style="font-size:1.5rem;margin-bottom:.5rem">{{ $item[4] === '#6C63FF' ? '👤' : ($item[4] === '#06B6D4' ? '📁' : ($item[4] === '#22C55E' ? '📝' : ($item[4] === '#F59E0B' ? '🖼️' : ($item[4] === '#EF4444' ? '⚡' : '✉️')))) }}</div>
      <div style="font-family:'Cormorant Garamond',serif;font-size:1.75rem;font-weight:600;color:#0B132B;line-height:1">{{ $item[1] }}</div>
      <div style="font-size:.65rem;color:#8B90A0;margin-top:.25rem;letter-spacing:.08em;text-transform:uppercase">{{ $item[0] }}</div>
    </a>
    @endforeach
  </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// ── Data from PHP ──
const viewsData = @json($viewsChart);
const hourlyData = @json($hourlyToday);
const deviceData = @json($deviceStats);
const contentData = {
  labels: ['Home','Talent','Work','Blog'],
  values: [{{ $homeViews }},{{ $talentViews }},{{ $workViews }},{{ $blogViews }}]
};
const inquiryTypeData = {
  labels: @json($inquiryTypes->pluck('type')->map(fn($t)=>ucwords(str_replace('_',' ',$t)))),
  values: @json($inquiryTypes->pluck('count'))
};

// ── Chart defaults ──
Chart.defaults.font.family = "'Inter', sans-serif";
Chart.defaults.color = '#8B90A0';

// ── Main Views + Inquiries Chart ──
const mainCtx = document.getElementById('mainChart').getContext('2d');
let mainChart = null;

function buildMainChart(data) {
  if (mainChart) mainChart.destroy();
  mainChart = new Chart(mainCtx, {
    type: 'line',
    data: {
      labels: data.map(d => d.label),
      datasets: [
        {
          label: 'Page Views',
          data: data.map(d => d.views),
          borderColor: '#6C63FF',
          backgroundColor: ctx => {
            const g = ctx.chart.ctx.createLinearGradient(0,0,0,280);
            g.addColorStop(0,'rgba(108,99,255,.25)');
            g.addColorStop(1,'rgba(108,99,255,0)');
            return g;
          },
          fill: true, tension: 0.4, borderWidth: 2.5,
          pointRadius: 3, pointHoverRadius: 6,
          pointBackgroundColor: '#6C63FF', pointBorderColor: '#fff', pointBorderWidth: 2,
        },
        {
          label: 'Inquiries',
          data: data.map(d => d.inquiries),
          borderColor: '#EF4444',
          backgroundColor: ctx => {
            const g = ctx.chart.ctx.createLinearGradient(0,0,0,280);
            g.addColorStop(0,'rgba(239,68,68,.2)');
            g.addColorStop(1,'rgba(239,68,68,0)');
            return g;
          },
          fill: true, tension: 0.4, borderWidth: 2.5,
          pointRadius: 3, pointHoverRadius: 6,
          pointBackgroundColor: '#EF4444', pointBorderColor: '#fff', pointBorderWidth: 2,
          yAxisID: 'y2',
        }
      ]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      interaction: { mode: 'index', intersect: false },
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: '#0B132B', titleColor: '#fff', bodyColor: 'rgba(255,255,255,.7)',
          borderColor: 'rgba(255,255,255,.1)', borderWidth: 1, padding: 12, cornerRadius: 8,
          callbacks: {
            title: items => items[0].label,
            label: item => ` ${item.dataset.label}: ${item.parsed.y}`,
          }
        }
      },
      scales: {
        x: { grid: { color: '#E4E6F0', drawBorder: false }, ticks: { maxTicksLimit: 8, font: { size: 11 } } },
        y: { position: 'left', grid: { color: '#E4E6F0', drawBorder: false }, ticks: { font: { size: 11 } }, title: { display: true, text: 'Views', font: { size: 11 } } },
        y2: { position: 'right', grid: { display: false }, ticks: { font: { size: 11 } }, title: { display: true, text: 'Inquiries', font: { size: 11 } } }
      }
    }
  });
}

buildMainChart(viewsData);

// ── Range buttons ──
let activeRange = 30;
document.querySelectorAll('.range-btn').forEach(btn => {
  btn.style.background = 'transparent'; btn.style.color = '#5E6472';
});
document.getElementById('range-30').style.background = '#6C63FF';
document.getElementById('range-30').style.color = '#fff';
document.getElementById('range-30').style.borderColor = '#6C63FF';

async function loadChart(range) {
  document.querySelectorAll('.range-btn').forEach(btn => {
    btn.style.background = 'transparent'; btn.style.color = '#5E6472'; btn.style.borderColor = '#E4E6F0';
  });
  const btn = document.getElementById('range-'+range);
  btn.style.background = '#6C63FF'; btn.style.color = '#fff'; btn.style.borderColor = '#6C63FF';
  const res  = await fetch(`{{ route('admin.dashboard') }}/analytics?range=${range}`);
  const data = await res.json();
  buildMainChart(data);
}

// ── Hourly Chart ──
new Chart(document.getElementById('hourlyChart').getContext('2d'), {
  type: 'bar',
  data: {
    labels: Array.from({length:24},(_,i)=>`${String(i).padStart(2,'0')}:00`),
    datasets: [{
      label: 'Views',
      data: hourlyData,
      backgroundColor: hourlyData.map((v,i) => {
        const hour = i; const isActive = hour >= 9 && hour <= 21;
        return isActive ? 'rgba(108,99,255,.7)' : 'rgba(108,99,255,.2)';
      }),
      borderRadius: 4, borderSkipped: false,
      hoverBackgroundColor: '#6C63FF',
    }]
  },
  options: {
    responsive: true, maintainAspectRatio: false,
    plugins: { legend: { display: false }, tooltip: { backgroundColor: '#0B132B', cornerRadius: 8, padding: 10 } },
    scales: {
      x: { grid: { display: false }, ticks: { maxTicksLimit: 12, font: { size: 10 } } },
      y: { grid: { color: '#E4E6F0', drawBorder: false }, ticks: { font: { size: 10 } }, beginAtZero: true }
    }
  }
});

// ── Device Donut ──
const devLabels = Object.keys(deviceData);
const devValues = Object.values(deviceData);
if (devLabels.length > 0) {
  new Chart(document.getElementById('deviceChart').getContext('2d'), {
    type: 'doughnut',
    data: {
      labels: devLabels,
      datasets: [{ data: devValues, backgroundColor: ['#6C63FF','#06B6D4','#F59E0B'], borderWidth: 0, hoverOffset: 4 }]
    },
    options: {
      responsive: true, maintainAspectRatio: true, cutout: '72%',
      plugins: { legend: { display: false }, tooltip: { backgroundColor: '#0B132B', cornerRadius: 8 } }
    }
  });
}

// ── Content Donut ──
new Chart(document.getElementById('contentChart').getContext('2d'), {
  type: 'doughnut',
  data: {
    labels: contentData.labels,
    datasets: [{ data: contentData.values, backgroundColor: ['#0B132B','#6C63FF','#06B6D4','#22C55E'], borderWidth: 0, hoverOffset: 4 }]
  },
  options: {
    responsive: true, maintainAspectRatio: true, cutout: '70%',
    plugins: { legend: { display: false }, tooltip: { backgroundColor: '#0B132B', cornerRadius: 8 } }
  }
});

// ── Inquiry Types Donut ──
if (inquiryTypeData.labels.length > 0) {
  new Chart(document.getElementById('inquiryTypeChart').getContext('2d'), {
    type: 'doughnut',
    data: {
      labels: inquiryTypeData.labels,
      datasets: [{ data: inquiryTypeData.values, backgroundColor: ['#6C63FF','#06B6D4','#22C55E','#F59E0B','#8B90A0'], borderWidth: 0, hoverOffset: 4 }]
    },
    options: {
      responsive: true, maintainAspectRatio: true, cutout: '70%',
      plugins: { legend: { display: false }, tooltip: { backgroundColor: '#0B132B', cornerRadius: 8 } }
    }
  });
} else {
  document.getElementById('inquiryTypeChart').style.display = 'none';
}
</script>
@endpush
