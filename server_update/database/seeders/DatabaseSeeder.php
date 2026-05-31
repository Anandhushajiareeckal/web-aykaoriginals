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
        $this->call(AboutSectionsTableSeeder::class);
        $this->call(AdminUsersTableSeeder::class);
        $this->call(BlogPostsTableSeeder::class);
        $this->call(CacheTableSeeder::class);
        $this->call(CacheLocksTableSeeder::class);
        $this->call(ClientLogosTableSeeder::class);
    }
}
