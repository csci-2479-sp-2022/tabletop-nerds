<?php

namespace Database\Seeders;

use App\Models\Ratings;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCollection = User::all();
        $userArray = $userCollection->all();

        $game1 = Game::where('id', 1)->first();
        $game2 = Game::where('id', 2)->first();
        $game3 = Game::where('id', 3)->first();
        $game4 = Game::where('id', 4)->first();

        $ratingFactory = Ratings::factory();
        $ratingFactory->count(1)->for($game1)->for($userArray[0])->create();
        $ratingFactory->count(1)->for($game2)->for($userArray[1])->create();
        $ratingFactory->count(1)->for($game1)->for($userArray[1])->create();
        $ratingFactory->count(1)->for($game3)->for($userArray[3])->create();
        $ratingFactory->count(1)->for($game4)->for($userArray[4])->create();

    }
}
