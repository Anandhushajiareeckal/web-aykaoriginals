<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_users')->delete();
        
        \DB::table('admin_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@aykaoriginals.com',
                'password' => '$2y$12$MIK30MYZfwjmC16U.jjXP.u9EfJQgMvJtlFheqwEl/jYPSSJTXI2u',
                'remember_token' => NULL,
                'created_at' => '2026-03-20 20:54:52',
                'updated_at' => '2026-03-20 20:54:52',
            ),
        ));
        
        
    }
}