<?php
namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\SiteSetting;

class AboutController extends Controller {
    public function index() {
        $sections = AboutSection::all()->keyBy('section_key');
        $settings = SiteSetting::all()->keyBy('key');
        return view('pages.about', compact('sections', 'settings'));
    }
}
