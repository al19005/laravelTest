<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Seeder;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
            'channel_name' => 'main',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        Channel::create([
            'channel_name' => 'general',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);

        Channel::create([
            'channel_name' => 'random',
            'created_at'     => now(),
            'updated_at'     => now()
        ]);
    }
}
