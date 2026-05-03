<?php
namespace App\Http\Controllers;
use App\Models\Project; use App\Models\Talent; use App\Models\Service;
use App\Models\SiteSetting; use App\Models\HomepageSection; use App\Models\ClientLogo;
use App\Models\BlogPost;
class HomeController extends Controller {
    public function index() {
        return view('pages.home', [
            'hero'            => HomepageSection::get('hero'),
            'clientsSection'  => HomepageSection::get('clients'),
            'aboutSection'    => HomepageSection::get('about'),
            'ctaSection'      => HomepageSection::get('cta'),
            'clients'         => ClientLogo::active()->orderBy('sort_order')->with('media')->get(),
            'featuredTalent'  => Talent::active()->featured()->with('media')->first(),
            'featuredProject' => Project::active()->featured()->with('media')->first(),
            'talents'         => Talent::active()->with('media')->inRandomOrder()->limit(8)->get(),
            'talentCount'     => Talent::active()->count(),
            'projectCount'    => Project::active()->count(),
            'services'        => Service::active()->orderBy('sort_order')->limit(4)->get(),
            'latestPosts'     => BlogPost::active()->latest('published_at')->limit(3)->get(),
            'settings'        => SiteSetting::all()->keyBy('key'),
        ]);
    }
}
