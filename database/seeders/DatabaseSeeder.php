<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\FollowersTableSeeder;
use Database\Seeders\ChannelsTableSeeder;
use Database\Seeders\JoinsTableSeeder;
use Database\Seeders\TweetsTableSeeder;
use Database\Seeders\CommentsTableSeeder;
use Database\Seeders\FavoritesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            FollowersTableSeeder::class,
            ChannelsTableSeeder::class,
            JoinsTableSeeder::class,
            TweetsTableSeeder::class,
            CommentsTableSeeder::class,
            FavoritesTableSeeder::class
        ]);
    }
}
