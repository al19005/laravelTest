<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Join;

class JoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Join::create([
                'channel_id' => 1,
                'user_id' => $i
            ]);
        }
    }
}
