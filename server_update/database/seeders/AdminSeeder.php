<?php
namespace Database\Seeders;
use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder {
    public function run(): void {
        AdminUser::firstOrCreate(['email'=>'admin@aykaoriginals.com'], [
            'name'     => 'Admin',
            'email'    => 'admin@aykaoriginals.com',
            'password' => Hash::make('Admin@2024!'),
        ]);
    }
}
