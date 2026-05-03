<?php
namespace Database\Seeders;
use App\Models\HomepageSection;
use App\Models\ClientLogo;
use Illuminate\Database\Seeder;
class HomepageSeeder extends Seeder {
    public function run(): void {
        $sections = [
            ['section_key'=>'hero','heading'=>'WHERE TALENT MEETS VISION','subheading'=>'AYKA ORIGINALS — Talent Management','body'=>'We represent extraordinary models and creative talents for the world\'s most discerning luxury fashion, editorial, and commercial brands.','video_url'=>'https://assets.mixkit.co/videos/preview/mixkit-fashion-model-posing-on-a-studio-background-34657-large.mp4','btn1_label'=>'Discover Talent','btn1_url'=>'/talent','btn2_label'=>'Our Work','btn2_url'=>'/work','is_active'=>true],
            ['section_key'=>'clients','heading'=>'Trusted By Leading Brands','subheading'=>'Our Clients','body'=>'','video_url'=>null,'btn1_label'=>null,'btn1_url'=>null,'btn2_label'=>null,'btn2_url'=>null,'is_active'=>true],
            ['section_key'=>'about','heading'=>'Premier Talent Management Since 2024','subheading'=>'About Us','body'=>'AYKA Originals is a boutique talent management agency representing exceptional models and creatives. We build careers, forge partnerships, and deliver outstanding results for every campaign we touch.','video_url'=>null,'btn1_label'=>'Learn More','btn1_url'=>'/about','btn2_label'=>null,'btn2_url'=>null,'is_active'=>true],
            ['section_key'=>'cta','heading'=>'Ready to Create Something Exceptional?','subheading'=>'Work With Us','body'=>'Submit a booking inquiry and our team will respond within 24 hours.','video_url'=>null,'btn1_label'=>'Contact Us','btn1_url'=>'/contact','btn2_label'=>null,'btn2_url'=>null,'is_active'=>true],
        ];
        foreach($sections as $s) HomepageSection::updateOrCreate(['section_key'=>$s['section_key']],$s);

        $clients = ['Vogue','Dior','Chanel','Louis Vuitton','Prada','Gucci','Versace','Balenciaga'];
        foreach($clients as $i => $name) {
            ClientLogo::firstOrCreate(['name'=>$name],['sort_order'=>$i+1,'is_active'=>true]);
        }
    }
}
