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

    public function searchGamesByTitle(string $title): ?Game
    {
        $result = Game::where('title', 'Like', "%{$title}%")->first();
        if ($result) {
            return $result;
        }
        return null;

    }

    public function getReviews(?Game $game){
        if($game != null){
            $reviewCollection = $game->reviews()->get();
            return $reviewCollection->all();
        }else{
            return null;
        }
    }

}
