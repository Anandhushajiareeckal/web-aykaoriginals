<?php
namespace Database\Seeders;
use App\Models\PageView;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class AnalyticsSeeder extends Seeder {
    public function run(): void {
        $pages   = ['','talent','talent/isabelle-moreau','talent/kenji-nakamura','work','work/maison-lumiere-2024','blog','services','about','gallery','contact'];
        $devices = ['desktop','desktop','desktop','mobile','mobile','tablet'];
        $browsers= ['Chrome','Chrome','Chrome','Firefox','Safari','Edge'];
        $now     = Carbon::now();
        for ($day = 59; $day >= 0; $day--) {
            $date      = $now->copy()->subDays($day);
            $isWeekend = in_array($date->dayOfWeek,[0,6]);
            $dayViews  = $isWeekend ? rand(15,35) : rand(25,70);
            for ($v = 0; $v < $dayViews; $v++) {
                PageView::create([
                    'page'     => $pages[array_rand($pages)],
                    'ip'       => rand(10,254).'.'.rand(0,255).'.'.rand(0,255).'.'.rand(1,254),
                    'device'   => $devices[array_rand($devices)],
                    'browser'  => $browsers[array_rand($browsers)],
                    'referrer' => rand(0,3) > 1 ? null : ['google.com','instagram.com','linkedin.com'][rand(0,2)],
                    'viewed_at'=> $date->copy()->setTime(rand(7,23),rand(0,59),rand(0,59)),
                ]);
            }
        }
    }
}
