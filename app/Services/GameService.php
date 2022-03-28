<?php

namespace App\Services;

use App\Contracts\GameInterface;
use App\Models\Game;
use App\Models\Publisher;
use App\Models\SearchResult;
use Illuminate\Support\Arr;

class GameService implements GameInterface
{
    public function getGameById(int $id): ?Game
    {
        foreach (self::getGames() as $game) {
            //placeholder until I make database call
            if ($game->id === $id) {
                return $game;
            }
        }
        return null;
    }

    public function getGames()
    {
      return

     Game::with(['publishers', 'categories'])->get();
    }


    public function searchGamesByTitle(string $title): array
    {
        return
            [
                SearchResult::make(['name' => 'Test search 1!'])
        ];
    }
}
