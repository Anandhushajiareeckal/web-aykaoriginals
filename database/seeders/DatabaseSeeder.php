<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            TalentSeeder::class,
            ProjectSeeder::class,
            SettingsSeeder::class,
            PageSeeder::class,
            ServiceSeeder::class,
            AdminSeeder::class,
            HomepageSeeder::class,
        ]);
    }
}
