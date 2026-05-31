<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GalleryItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('gallery_items')->delete();
        
        \DB::table('gallery_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => NULL,
                'category' => 'cat1',
                'sort_order' => 0,
                'is_active' => 1,
                'created_at' => '2026-03-21 13:20:28',
                'updated_at' => '2026-03-21 13:20:28',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => NULL,
                'category' => 'cat2',
                'sort_order' => 0,
                'is_active' => 1,
                'created_at' => '2026-03-21 13:24:25',
                'updated_at' => '2026-03-21 13:24:25',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => NULL,
                'category' => 'cat1',
                'sort_order' => 0,
                'is_active' => 1,
                'created_at' => '2026-03-21 13:25:40',
                'updated_at' => '2026-03-21 13:25:40',
            ),
        ));
        
        
    }
}