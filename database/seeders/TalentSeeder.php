<?php
namespace Database\Seeders;
use App\Models\Talent; use Illuminate\Database\Seeder; use Illuminate\Support\Str;
class TalentSeeder extends Seeder {
    public function run(): void {
        $data = [
            ['name'=>'Isabelle Moreau','gender'=>'female','category'=>'fashion','location'=>'Paris, France','height'=>"5'11\" / 180cm",'chest_bust'=>"32\" / 81cm",'waist'=>"24\" / 61cm",'hips'=>"34\" / 86cm",'shoe_size'=>'EU 39','eye_color'=>'Green','hair_color'=>'Brunette','bio'=>'Isabelle is a Paris-based fashion model with over eight years of experience in luxury editorial and runway.','is_featured'=>true,'is_active'=>true],
            ['name'=>'Kenji Nakamura','gender'=>'male','category'=>'commercial','location'=>'Tokyo, Japan','height'=>"6'1\" / 185cm",'chest_bust'=>"39\" / 99cm",'waist'=>"31\" / 79cm",'hips'=>"37\" / 94cm",'shoe_size'=>'EU 44','eye_color'=>'Brown','hair_color'=>'Black','bio'=>'Kenji combines athletic elegance with quiet intensity. Based in Tokyo, he has worked with global luxury brands.','is_featured'=>false,'is_active'=>true],
            ['name'=>'Amara Diallo','gender'=>'female','category'=>'editorial','location'=>'New York, USA','height'=>"5'10\" / 177cm",'chest_bust'=>"33\" / 84cm",'waist'=>"25\" / 63cm",'hips'=>"35\" / 89cm",'shoe_size'=>'EU 40','eye_color'=>'Dark Brown','hair_color'=>'Black','bio'=>'Amara is a force in editorial modeling, known for her expressive range.','is_featured'=>false,'is_active'=>true],
            ['name'=>'Sven Lindqvist','gender'=>'male','category'=>'fashion','location'=>'Stockholm, Sweden','height'=>"6'2\" / 188cm",'chest_bust'=>"40\" / 101cm",'waist'=>"32\" / 81cm",'hips'=>"38\" / 97cm",'shoe_size'=>'EU 45','eye_color'=>'Blue','hair_color'=>'Blonde','bio'=>'Swedish-born Sven brings Nordic cool to every campaign.','is_featured'=>false,'is_active'=>true],
            ['name'=>'Valentina Cruz','gender'=>'female','category'=>'runway','location'=>'Milan, Italy','height'=>"5'10\" / 178cm",'chest_bust'=>"32\" / 81cm",'waist'=>"23\" / 58cm",'hips'=>"33\" / 84cm",'shoe_size'=>'EU 38','eye_color'=>'Hazel','hair_color'=>'Dark Brown','bio'=>"A mainstay of Milan Fashion Week, Valentina's fluid movement on the runway has made her a favourite of luxury casting directors.",'is_featured'=>false,'is_active'=>true],
            ['name'=>'Leo Fontaine','gender'=>'non-binary','category'=>'editorial','location'=>'London, UK','height'=>"5'9\" / 175cm",'chest_bust'=>"34\" / 86cm",'waist'=>"27\" / 69cm",'hips'=>"35\" / 89cm",'shoe_size'=>'EU 42','eye_color'=>'Grey','hair_color'=>'Varied','bio'=>'Leo is a boundary-pushing editorial presence, bringing a fluid, avant-garde sensibility to every project.','is_featured'=>false,'is_active'=>true],
        ];
        foreach($data as $d) Talent::firstOrCreate(['slug'=>Str::slug($d['name'])],$d);
    }
}
