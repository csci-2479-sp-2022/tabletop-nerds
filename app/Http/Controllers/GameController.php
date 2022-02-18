<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    public function show(){
        return view(
            'game-list',
            [
                'games' => self::getGames(),
            ]
        );
    }

    public function getGames(){
        return [
            Game::make(['name' => 'Monopoly', 'type' => 'multiplayer elimination', 'publication' => '1935', 
            'description' => 'Monopoly is a multi-player economics-themed board game. In the game, players roll two dice to move around the game board, buying and trading properties, and developing them with houses and hotels. Players collect rent from their opponents, with the goal being to drive them into bankruptcy.',
            'rating' => '7/10', 'complexity' => 'intermediate', 'cost' => '$30.00'])
        ];
    }

}
