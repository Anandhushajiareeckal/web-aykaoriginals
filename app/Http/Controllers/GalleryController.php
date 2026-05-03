<?php
namespace App\Http\Controllers;
use App\Models\GalleryItem;
class GalleryController extends Controller {
    public function index() {
        $items      = GalleryItem::active()->with('media')->orderBy('sort_order')->get();
        $categories = GalleryItem::active()->distinct()->pluck('category')->filter()->sort()->values();
        return view('gallery.index', compact('items','categories'));
    }
}
