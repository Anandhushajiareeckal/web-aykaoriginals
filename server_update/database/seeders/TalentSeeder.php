<?php
namespace Database\Seeders;
use App\Models\Talent;
use Illuminate\Database\Seeder;

class TalentSeeder extends Seeder {
    public function run(): void {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \DB::table('talents')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $talents = [
            [
                'name'       => 'Sofia Reyes',
                'slug'       => 'sofia-reyes',
                'type'       => 'talent',
                'category'   => 'Model',
                'gender'     => 'female',
                'location'   => 'New York, USA',
                'height'     => "5'11\"",
                'chest_bust' => '34',
                'waist'      => '24',
                'hips'       => '35',
                'eye_color'  => 'Green',
                'hair_color' => 'Auburn',
                'bio'        => 'Sofia is a high-fashion editorial model with campaigns spanning Vogue, Harper\'s Bazaar and international luxury brands. Her striking presence has graced runways in Milan, Paris and New York.',
                'status'     => 'approved',
                'is_active'  => true,
                'is_featured'=> true,
            ],
            [
                'name'       => 'Marcus Chen',
                'slug'       => 'marcus-chen',
                'type'       => 'talent',
                'category'   => 'Actor',
                'gender'     => 'male',
                'location'   => 'Los Angeles, USA',
                'height'     => "6'1\"",
                'chest_bust' => '42',
                'waist'      => '32',
                'hips'       => '38',
                'eye_color'  => 'Brown',
                'hair_color' => 'Black',
                'bio'        => 'Marcus is a versatile actor known for his work in award-winning indie films and major studio productions. His commanding presence and range make him a sought-after name across continents.',
                'status'     => 'approved',
                'is_active'  => true,
                'is_featured'=> true,
            ],
            [
                'name'       => 'Amara Diallo',
                'slug'       => 'amara-diallo',
                'type'       => 'talent',
                'category'   => 'Influencer',
                'gender'     => 'female',
                'location'   => 'Paris, France',
                'height'     => "5'9\"",
                'chest_bust' => '32',
                'waist'      => '23',
                'hips'       => '34',
                'eye_color'  => 'Dark Brown',
                'hair_color' => 'Black',
                'bio'        => 'Amara is a luxury lifestyle influencer with over 4.2M followers across platforms. Originally from Dakar, she brings a global perspective to fashion, travel, and culture.',
                'status'     => 'approved',
                'is_active'  => true,
                'is_featured'=> true,
            ],
            [
                'name'       => 'Luca Moretti',
                'slug'       => 'luca-moretti',
                'type'       => 'talent',
                'category'   => 'Model',
                'gender'     => 'male',
                'location'   => 'Milan, Italy',
                'height'     => "6'2\"",
                'chest_bust' => '40',
                'waist'      => '30',
                'hips'       => '36',
                'eye_color'  => 'Blue',
                'hair_color' => 'Dark Brown',
                'bio'        => 'Luca is a top menswear model from Milan whose sculptural features have made him the face of several top European fashion houses. He has walked for Valentino, Dior Homme, and Versace.',
                'status'     => 'approved',
                'is_active'  => true,
                'is_featured'=> false,
            ],
            [
                'name'       => 'Yuna Park',
                'slug'       => 'yuna-park',
                'type'       => 'talent',
                'category'   => 'Musician',
                'gender'     => 'female',
                'location'   => 'Seoul, South Korea',
                'height'     => "5'6\"",
                'chest_bust' => '32',
                'waist'      => '24',
                'hips'       => '34',
                'eye_color'  => 'Brown',
                'hair_color' => 'Black',
                'bio'        => 'Yuna is a K-pop artist and producer breaking global barriers with her genre-blending sound. Her debut album charted in 14 countries and earned three international music awards.',
                'status'     => 'approved',
                'is_active'  => true,
                'is_featured'=> true,
            ],
            [
                'name'       => 'Jordan Blake',
                'slug'       => 'jordan-blake',
                'type'       => 'talent',
                'category'   => 'Actor',
                'gender'     => 'male',
                'location'   => 'London, UK',
                'height'     => "5'11\"",
                'chest_bust' => '41',
                'waist'      => '31',
                'hips'       => '37',
                'eye_color'  => 'Hazel',
                'hair_color' => 'Blonde',
                'bio'        => 'Jordan is a British actor with theatre and screen credits spanning the West End and Hollywood. An alumnus of RADA, he brings classical training to contemporary storytelling.',
                'status'     => 'approved',
                'is_active'  => true,
                'is_featured'=> false,
            ],
        ];

        // Use Picsum to avoid Unsplash bot blocking
        $images = [
            'https://picsum.photos/seed/t1/800/1000',
            'https://picsum.photos/seed/t2/800/1000',
            'https://picsum.photos/seed/t3/800/1000',
            'https://picsum.photos/seed/t4/800/1000',
            'https://picsum.photos/seed/t5/800/1000',
            'https://picsum.photos/seed/t6/800/1000',
        ];

        foreach ($talents as $index => $t) {
            $talent = Talent::create($t);
            try {
                $talent->addMediaFromUrl($images[$index % count($images)])->toMediaCollection('profile');
                $talent->addMediaFromUrl($images[$index % count($images)])->toMediaCollection('cover');
            } catch (\Exception $e) {
                // Ignore missing images on dev seeds
            }
        }
    }
}
