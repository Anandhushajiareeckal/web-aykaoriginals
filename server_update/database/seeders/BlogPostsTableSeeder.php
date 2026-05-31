<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BlogPostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('blog_posts')->delete();
        
        \DB::table('blog_posts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Dummy Journal 1',
                'slug' => 'dummy-journal-1',
                'excerpt' => NULL,
                'content' => '<p>This is a dummy journal post created for demonstration purposes. It highlights the latest trends and insights from the fashion industry.</p>',
                'category' => 'Fashion',
                'is_active' => 1,
                'published_at' => '2026-04-29 16:58:34',
                'created_at' => '2026-04-29 16:58:34',
                'updated_at' => '2026-04-29 16:58:34',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Dummy Journal 2',
                'slug' => 'dummy-journal-2',
                'excerpt' => NULL,
                'content' => '<p>This is a dummy journal post created for demonstration purposes. It highlights the latest trends and insights from the fashion industry.</p>',
                'category' => 'Fashion',
                'is_active' => 1,
                'published_at' => '2026-04-29 16:58:34',
                'created_at' => '2026-04-29 16:58:34',
                'updated_at' => '2026-04-29 16:58:34',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Dummy Journal 3',
                'slug' => 'dummy-journal-3',
                'excerpt' => NULL,
                'content' => '<p>This is a dummy journal post created for demonstration purposes. It highlights the latest trends and insights from the fashion industry.</p>',
                'category' => 'Fashion',
                'is_active' => 1,
                'published_at' => '2026-04-29 16:58:34',
                'created_at' => '2026-04-29 16:58:34',
                'updated_at' => '2026-04-29 16:58:34',
            ),
        ));
        
        
    }
}