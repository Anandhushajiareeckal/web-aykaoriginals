<?php
namespace App\Http\Middleware;
use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
class TrackPageView {
    public function handle(Request $request, Closure $next) {
        $response = $next($request);
        if ($request->isMethod('GET') && !$request->is('admin*') && !$request->is('storage*')) {
            try {
                $ua = $request->userAgent() ?? '';
                $device = 'desktop';
                if (preg_match('/Mobile|Android|iPhone/i', $ua)) $device = 'mobile';
                elseif (preg_match('/iPad|Tablet/i', $ua)) $device = 'tablet';
                $browser = 'Other';
                if (str_contains($ua,'Chrome') && !str_contains($ua,'Edg')) $browser = 'Chrome';
                elseif (str_contains($ua,'Firefox')) $browser = 'Firefox';
                elseif (str_contains($ua,'Safari') && !str_contains($ua,'Chrome')) $browser = 'Safari';
                elseif (str_contains($ua,'Edg')) $browser = 'Edge';
                PageView::create([
                    'page'     => $request->path(),
                    'ip'       => $request->ip(),
                    'device'   => $device,
                    'browser'  => $browser,
                    'referrer' => $request->header('referer'),
                ]);
            } catch (\Throwable $e) {}
        }
        return $response;
    }
}
