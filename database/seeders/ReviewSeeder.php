<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
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
        
        $reviewFactory = Review::factory();
        $reviewFactory->count(1)->for($game1)->for($userArray[0])->create();
        $reviewFactory->count(1)->for($game2)->for($userArray[4])->create();
        $reviewFactory->count(1)->for($game1)->for($userArray[4])->create();
        $reviewFactory->count(1)->for($game2)->for($userArray[2])->create();
        $reviewFactory->count(1)->for($game1)->for($userArray[3])->create();
        $reviewFactory->count(1)->for($game2)->for($userArray[1])->create();

    }

    
}
