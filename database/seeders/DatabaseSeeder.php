<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            UserSeeder::class,
            PublisherSeeder::class,
            CategorySeeder::class,
            GameSeeder::class,
            ReviewSeeder::class,
            WishlistSeeder::class,
            RatingsSeeder::class,
        ]);
    }
}
