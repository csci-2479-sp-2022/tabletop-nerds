<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publisher;
use App\Models\Game;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = Publisher::factory();

        $factory->createMany([
            [
                'name' => 'Fantasy Flight Games',
                'code' => 'FFG'
            ],
            [
                'name' => 'Stonemaier Games',
                'code' => 'SMG'
            ],
            [
                'name' => 'Hans im Glück',
                'code' => 'HIG'
            ]

        ]);
    }
}
