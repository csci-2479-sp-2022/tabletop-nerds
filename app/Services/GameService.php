<?php

namespace App\Services;

use App\Contracts\GameInterface;
use App\Models\Game;
use App\Models\SearchResult;
use Illuminate\Support\Arr;

class GameService implements GameInterface
{

    public function getGameById(int $id): ?Game
    {
        foreach (self::getGames() as $game) {
            if ($game->id === $id) {
                return $game;
            }
        }
        return null;
    }

    public function getGames(){
        return
            Game::with(['publisher', 'categories'])->get();
    }


    public function searchGamesByTitle(string $title): array
    {
        return
            [
                SearchResult::make(['name' => 'Test search 1!'])
            ];
    }
}
