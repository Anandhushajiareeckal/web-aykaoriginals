<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Talent; use App\Models\Project; use App\Models\Inquiry;
use App\Models\BlogPost; use App\Models\GalleryItem; use App\Models\Service;
use App\Models\PageView; use App\Models\SiteAnalytics;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardController extends Controller {
    public function index() {
        $now  = Carbon::now();
        $days = 30;

        // ── Stats ──
        $talentCount   = Talent::count();
        $projectCount  = Project::count();
        $inquiryCount  = Inquiry::count();
        $newInquiries  = Inquiry::where('status','new')->count();
        $blogCount     = BlogPost::count();
        $galleryCount  = GalleryItem::count();
        $serviceCount  = Service::count();

        // ── Total views last 30 days ──
        $totalViews30 = PageView::where('viewed_at', '>=', $now->copy()->subDays($days))->count();
        $totalViewsPrev = PageView::whereBetween('viewed_at', [$now->copy()->subDays($days*2), $now->copy()->subDays($days)])->count();
        $viewsGrowth = $totalViewsPrev > 0 ? round((($totalViews30 - $totalViewsPrev) / $totalViewsPrev) * 100, 1) : 0;

        // ── Views chart: last 30 days daily ──
        $viewsChart = collect();
        for ($i = $days - 1; $i >= 0; $i--) {
            $date  = $now->copy()->subDays($i)->format('Y-m-d');
            $label = $now->copy()->subDays($i)->format('M d');
            $count = PageView::whereDate('viewed_at', $date)->count();
            $inqs  = Inquiry::whereDate('created_at', $date)->count();
            $viewsChart->push(['date'=>$date,'label'=>$label,'views'=>$count,'inquiries'=>$inqs]);
        }

        // ── Inquiries last 30 days chart ──
        $inquiriesChart = Inquiry::where('created_at','>=', $now->copy()->subDays($days))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')->orderBy('date')->get();

        // ── Page breakdown (top pages) ──
        $topPages = PageView::where('viewed_at','>=', $now->copy()->subDays($days))
            ->selectRaw('page, COUNT(*) as views')
            ->groupBy('page')->orderByDesc('views')->limit(8)->get();

        // ── Device breakdown ──
        $deviceStats = PageView::where('viewed_at','>=', $now->copy()->subDays($days))
            ->selectRaw('device, COUNT(*) as count')
            ->groupBy('device')->get()
            ->mapWithKeys(fn($r) => [$r->device => $r->count]);

        // ── Browser breakdown ──
        $browserStats = PageView::where('viewed_at','>=', $now->copy()->subDays($days))
            ->selectRaw('browser, COUNT(*) as count')
            ->groupBy('browser')->orderByDesc('count')->limit(5)->get();

        // ── Inquiry types ──
        $inquiryTypes = Inquiry::where('created_at','>=', $now->copy()->subDays($days))
            ->selectRaw('type, COUNT(*) as count')
            ->groupBy('type')->orderByDesc('count')->get();

        // ── Inquiry status breakdown ──
        $inquiryStatus = Inquiry::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')->get()
            ->mapWithKeys(fn($r) => [$r->status => $r->count]);

        // ── Weekly comparison (this week vs last week) ──
        $thisWeek = PageView::where('viewed_at','>=', $now->copy()->startOfWeek())->count();
        $lastWeek = PageView::whereBetween('viewed_at', [$now->copy()->subWeek()->startOfWeek(), $now->copy()->subWeek()->endOfWeek()])->count();

        // ── Hourly activity today ──
        $hourlyToday = [];
        for ($h = 0; $h < 24; $h++) {
            $hourlyToday[] = PageView::whereDate('viewed_at', today())
                ->whereRaw('HOUR(viewed_at) = ?', [$h])->count();
        }

        // ── Content views breakdown (30 days) ──
        $talentViews  = PageView::where('viewed_at','>=', $now->copy()->subDays($days))->where('page','like','talent%')->count();
        $workViews    = PageView::where('viewed_at','>=', $now->copy()->subDays($days))->where('page','like','work%')->count();
        $blogViews    = PageView::where('viewed_at','>=', $now->copy()->subDays($days))->where('page','like','blog%')->count();
        $homeViews    = PageView::where('viewed_at','>=', $now->copy()->subDays($days))->where('page','')->count();

        // ── Recent inquiries ──
        $recentInquiries = Inquiry::with('talent')->latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'talentCount','projectCount','inquiryCount','newInquiries',
            'blogCount','galleryCount','serviceCount',
            'totalViews30','viewsGrowth','viewsChart',
            'inquiriesChart','topPages','deviceStats','browserStats',
            'inquiryTypes','inquiryStatus','thisWeek','lastWeek',
            'hourlyToday','talentViews','workViews','blogViews','homeViews',
            'recentInquiries'
        ));
    }

    public function analyticsApi() {
        $range = request('range', 30);
        $data  = collect();
        for ($i = $range - 1; $i >= 0; $i--) {
            $date  = now()->subDays($i)->format('Y-m-d');
            $label = now()->subDays($i)->format('M d');
            $data->push([
                'date'      => $date,
                'label'     => $label,
                'views'     => PageView::whereDate('viewed_at', $date)->count(),
                'inquiries' => Inquiry::whereDate('created_at', $date)->count(),
            ]);
        }
        return response()->json($data);
    }
}
