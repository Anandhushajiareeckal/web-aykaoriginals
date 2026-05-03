<?php
namespace App\Http\Controllers;
use App\Models\Page;
class PageController extends Controller {
    public function show(string $slug) {
        $page = Page::active()->where('slug',$slug)->firstOrFail();
        $template = 'pages.'.$page->template;
        if(!view()->exists($template)) $template = 'pages.default';
        return view($template, compact('page'));
    }
}
