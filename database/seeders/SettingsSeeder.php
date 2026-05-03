<?php
namespace Database\Seeders;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
class SettingsSeeder extends Seeder {
    public function run(): void {
        $settings = [
            ['key'=>'site_name',          'value'=>'AYKA ORIGINALS'],
            ['key'=>'site_tagline',        'value'=>'Talent Management'],
            ['key'=>'site_email',          'value'=>'bookings@aykaoriginals.com'],
            ['key'=>'site_phone',          'value'=>'+1 (000) 000-0000'],
            ['key'=>'site_address',        'value'=>'New York, NY'],
            ['key'=>'hero_heading',        'value'=>'AYKA ORIGINALS'],
            ['key'=>'hero_subheading',     'value'=>'Talent Management'],
            ['key'=>'hero_body',           'value'=>'Representing extraordinary talent for luxury fashion, editorial, and commercial campaigns worldwide.'],
            ['key'=>'about_heading',       'value'=>'About AYKA Originals'],
            ['key'=>'about_body',          'value'=>'AYKA Originals is a premier talent management agency founded in 2024. We represent the finest models and creative talents for the world\'s most discerning brands.'],
            ['key'=>'footer_text',         'value'=>'A premier talent management agency representing extraordinary talent globally.'],
            ['key'=>'instagram_url',       'value'=>'#'],
            ['key'=>'linkedin_url',        'value'=>'#'],
            ['key'=>'primary_color',       'value'=>'#0B132B'],
        ];
        foreach($settings as $s) SiteSetting::updateOrCreate(['key'=>$s['key']],['value'=>$s['value']]);
    }
}
