<?php
namespace Database\Seeders;
use App\Models\Project; use Illuminate\Database\Seeder; use Illuminate\Support\Str;
class ProjectSeeder extends Seeder {
    public function run(): void {
        $data = [
            ['brand'=>'Maison Lumiere','year'=>2024,'service_type'=>'Campaign Production','description'=>'A full AW24 campaign for Parisian luxury house Maison Lumiere, shot across three days in the Marais district. We provided creative direction, talent casting, photography production, and post-production supervision.','is_featured'=>true,'is_active'=>true],
            ['brand'=>'Noir Studio','year'=>2024,'service_type'=>'Editorial','description'=>'A six-page editorial for Noir Studio published in international fashion press. Our team handled art direction, talent selection, and full location production.','is_featured'=>false,'is_active'=>true],
            ['brand'=>'Veld and Co','year'=>2023,'service_type'=>'Lookbook','description'=>'SS23 lookbook for Danish menswear brand Veld and Co. Clean, architectural imagery produced in our studio against minimal backdrops.','is_featured'=>false,'is_active'=>true],
            ['brand'=>'Atelier Blanc','year'=>2023,'service_type'=>'Campaign Production','description'=>'A brand-defining campaign for emerging luxury label Atelier Blanc, positioning them as a serious player in the international fashion market.','is_featured'=>false,'is_active'=>true],
        ];
        foreach($data as $d) Project::firstOrCreate(['slug'=>Str::slug($d['brand'].'-'.$d['year'])],$d);
    }
}
