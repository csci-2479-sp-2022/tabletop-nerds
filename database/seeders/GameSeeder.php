<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Game;
use App\Models\GameRating;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Publishers
        $fantasy = Publisher::where('code', 'FFG')->first();
        $stonemaier = Publisher::where('code', 'SMG')->first();


        //Categories

        $abstract = Category::where('code', 'ABS')->first();
        $legacy = Category::where('code', 'LGS')->first();
        // $drafting = Category::where('name', 'Drafting')->first();
        // $roll = Category::where('name', 'Roll-and-move')->first();

        //Games
        $fantasy->games()->createMany([
            [

                'title' => "Hey, that's my fish!",
                'complexity_rating' => 2.5,
                'cost' => 20.00,
                'release_year' => '2004',
                'playing_time_minutes' => 20,
                'min_number_players' => 2,
                'max_number_players' => 4,
                'description' => 'Hey, That is My Fish! is an engaging, award-winning board game of strategic fish hunting, in which 2-4 players control determined penguins hungry for their next meal on a bustling Antarctic ice floe.',
                'img_url' => 'https://cdn.shopify.com/s/files/1/0355/9119/2709/products/9781616611712_p0_v2_s550x406_5b5adfef-f28a-41f6-a265-d9300a3126fe.jpg?v=1611294077',

            ],
            [

                'title' => "Monopoly",
                'complexity_rating' => 7,
                'cost' => 30.00,
                'release_year' => '1935',
                'playing_time_minutes' => 60,
                'min_number_players' => 2,
                'max_number_players' => 8,
                'description' => 'Monopoly is a multi-player economics-themed board game. In the game, players roll two dice to move around the game board, buying and trading properties, and developing them with houses and hotels. Players collect rent from their opponents, with the goal being to drive them into bankruptcy.',

                'img_url' => 'https://images.unsplash.com/photo-1640461470346-c8b56497850a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80/1000',

            ]
        ]);


        $stonemaier->games()->createMany(
            [
                [
                    'title' => 'Chartestone',
                    'complexity_rating' => 7.6,
                    'cost' => 35,
                    'release_year' => 2000,
                    'playing_time_minutes' => 60,
                    'min_number_players' => 1,
                    'max_number_players' => 6,
                    'description' => 'The prosperous Kingdom of Greengully, ruled for centuries by the Forever King, has issued a decree to its citizens to colonize the vast lands beyond its borders. In an effort to start a new village, the Forever King has selected 6 citizens for the task, each of whom has a unique set of skills they use to build their charter.',
                    'img_url' => 'https://m.media-amazon.com/images/S/aplus-media/vc/6c8114a1-97f1-48f9-a581-ec4c1671e713._SR285,285_.jpg',

                ],
                [
                    'title' => 'Sequence',
                    'complexity_rating' => 6,
                    'cost' => 25,
                    'release_year' => 1982,
                    'playing_time_minutes' => 30,
                    'min_number_players' => 2,
                    'max_number_players' => 12,
                    'description' => 'Sequence is a hybrid of a board game and a card game. The board consists of two decks of cards laid out in a 10×10 pattern, excluding the eight jacks that play a very important role, which we will discuss later. There are four empty corners that serve as free spaces for the players to use.',
                    'img_url' => 'https://i.pinimg.com/originals/15/5f/15/155f15530f5fa96b4a1df07d4cb92d57.jpg',

                ]
            ]

        );

        $fish = Game::where('title', "Hey, that's my fish!")->first();
        $fish->categories()->attach([
            $abstract->id,
            $legacy->id
        ]);
        $test = Game::where('title', "Monopoly")->first();
        $test->categories()->attach([
            $abstract->id,
            $legacy->id
        ]);

        $chartestone = Game::where('title', 'Chartestone')->first();
        $chartestone->categories()->attach([
            $legacy->id,
            $abstract->id,
        ]);

        $test2 = Game::where('title', 'Sequence')->first();
        $test2->categories()->attach([
            $abstract->id,
            $legacy->id,
        ]);
    }
}
