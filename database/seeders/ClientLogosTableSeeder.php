<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClientLogosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('client_logos')->delete();
        
        \DB::table('client_logos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Vogue',
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => '2026-03-20 23:26:04',
                'updated_at' => '2026-03-20 23:26:04',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Dior',
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => '2026-03-20 23:26:04',
                'updated_at' => '2026-03-20 23:26:04',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Chanel',
                'sort_order' => 3,
                'is_active' => 1,
                'created_at' => '2026-03-20 23:26:04',
                'updated_at' => '2026-03-20 23:26:04',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Louis Vuitton',
                'sort_order' => 4,
                'is_active' => 1,
                'created_at' => '2026-03-20 23:26:04',
                'updated_at' => '2026-03-20 23:26:04',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Prada',
                'sort_order' => 5,
                'is_active' => 1,
                'created_at' => '2026-03-20 23:26:04',
                'updated_at' => '2026-03-20 23:26:04',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Gucci',
                'sort_order' => 6,
                'is_active' => 1,
                'created_at' => '2026-03-20 23:26:04',
                'updated_at' => '2026-03-20 23:26:04',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Versace',
                'sort_order' => 7,
                'is_active' => 1,
                'created_at' => '2026-03-20 23:26:04',
                'updated_at' => '2026-03-20 23:26:04',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Balenciaga',
                'sort_order' => 8,
                'is_active' => 1,
                'created_at' => '2026-03-20 23:26:04',
                'updated_at' => '2026-03-20 23:26:04',
            ),
            8 => 
            array (
                'id' => 10,
                'name' => 'JOCKEY',
                'sort_order' => 0,
                'is_active' => 1,
                'created_at' => '2026-05-01 13:27:52',
                'updated_at' => '2026-05-01 13:27:52',
            ),
        ));
        
        
    }
}