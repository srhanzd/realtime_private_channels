<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 24; $i++) {
            User::create([
                'name' => 'srhan  ' . Str::random(5),
                'email' => Str::random(5) . '@gmail.com',
                'password' =>  bcrypt('srhan'),
                'api_token' => Str::random(60),
                'remember_token' => Str::random(10),
            ]);
        }for ($i = 0; $i <= 20; $i++) {
            Post::create([
                'title' => 'title'.$i.Str::random(4),
                'content' =>Str::random(10),
                'published' => rand(0,1),
                'user_id'=>rand(1,25)
            ]);
        }
    }
}
