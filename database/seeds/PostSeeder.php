<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::unguard();
        Post::truncate();
        factory(Post::class, 50)->create();
        Post::reguard();
    }
}
