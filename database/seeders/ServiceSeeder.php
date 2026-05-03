<?php
namespace Database\Seeders;
use App\Models\Service;
use Illuminate\Database\Seeder;
class ServiceSeeder extends Seeder {
    public function run(): void {
        $services = [
            ['title'=>'Talent Management','description'=>'Strategic representation for models and creatives at every career stage.','icon'=>'star','sort_order'=>1,'is_active'=>true],
            ['title'=>'Campaign Production','description'=>'End-to-end campaign production for luxury fashion and beauty brands.','icon'=>'camera','sort_order'=>2,'is_active'=>true],
            ['title'=>'Editorial Direction','description'=>'Creative direction and styling for magazine editorials and lookbooks.','icon'=>'edit','sort_order'=>3,'is_active'=>true],
            ['title'=>'Brand Consulting','description'=>'Strategic brand development and visual identity consulting.','icon'=>'briefcase','sort_order'=>4,'is_active'=>true],
        ];
        foreach($services as $s) Service::firstOrCreate(['title'=>$s['title']], $s);
    }
}
