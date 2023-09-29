<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        factory(User::class, 20)->create()->each(function ($s) {
            $s->spots()->saveMany(factory(Post::class, 10)->create());
        });
    }
}
