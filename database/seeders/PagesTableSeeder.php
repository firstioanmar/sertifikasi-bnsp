<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pages')->insert([
            [
                'slug' => 'home',
                'content' => '<p>Welcome to the Home page. This content is loaded from the database.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'about',
                'content' => '<p>This is the About page. Here you can add information about your website or company.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slug' => 'contact',
                'content' => '<p>Contact us at contact@example.com or call 123-456-7890.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
