<?php
namespace Database\Seeders;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class PageSeeder extends Seeder {
    public function run(): void {
        $pages = [
            ['title'=>'About','slug'=>'about','template'=>'about','sort_order'=>1,'is_active'=>true,'content'=>'<h2>About AYKA Originals</h2><p>AYKA Originals is a premier talent management agency founded in 2024, representing extraordinary models and creatives for the world\'s most discerning luxury brands.</p><p>Our philosophy is simple: curate exceptional talent, build meaningful partnerships, and deliver outstanding results for every campaign we touch.</p>','meta_title'=>'About — AYKA Originals','meta_description'=>'Learn about AYKA Originals, a premier talent management agency.'],
            ['title'=>'Services','slug'=>'services','template'=>'services','sort_order'=>2,'is_active'=>true,'content'=>'<h2>Our Services</h2><p>From talent management to full campaign production, we offer a complete range of services for luxury fashion brands.</p>','meta_title'=>'Services — AYKA Originals','meta_description'=>'Premium talent management and production services.'],
            ['title'=>'Gallery','slug'=>'gallery','template'=>'gallery','sort_order'=>3,'is_active'=>true,'content'=>'<h2>Gallery</h2><p>A curated selection of our finest editorial and campaign work.</p>','meta_title'=>'Gallery — AYKA Originals','meta_description'=>'Gallery of campaigns and editorials by AYKA Originals.'],
            ['title'=>'Blog','slug'=>'blog','template'=>'blog','sort_order'=>4,'is_active'=>true,'content'=>'<h2>Latest News</h2><p>Industry insights, campaign features, and agency news from AYKA Originals.</p>','meta_title'=>'Blog — AYKA Originals','meta_description'=>'News and insights from AYKA Originals talent management.'],
            ['title'=>'Contact','slug'=>'contact','template'=>'contact','sort_order'=>5,'is_active'=>true,'content'=>'<h2>Contact Us</h2><p>Get in touch with our team for talent bookings, production inquiries, or general information.</p>','meta_title'=>'Contact — AYKA Originals','meta_description'=>'Contact AYKA Originals for bookings and inquiries.'],
        ];
        foreach($pages as $p) Page::firstOrCreate(['slug'=>$p['slug']], $p);
    }
}
