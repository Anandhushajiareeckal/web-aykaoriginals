<?php
namespace App\Http\Controllers;
use App\Models\Service;
class ServiceController extends Controller {
    public function index() {
        $services = Service::active()->orderBy('sort_order')->get();
        $sections = \App\Models\ServiceSection::all()->keyBy('section_key');
        return view('services.index', compact('services', 'sections'));
    }

    public function show($slug) {
        $service = Service::active()->where('slug', $slug)->firstOrFail();
        $otherServices = Service::active()->where('id', '!=', $service->id)->inRandomOrder()->limit(3)->get();
        return view('services.show', compact('service', 'otherServices'));
    }
}
