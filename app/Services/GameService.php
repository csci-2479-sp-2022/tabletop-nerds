<?php

namespace App\Services;

use App\Contracts\GameInterface;
use App\Models\Game;
use App\Models\Review;

class GameService implements GameInterface
{

    public function getGameById(int $id): ?Game
    {
        return Game::find($id);
    }

    public function getGames()
    {
        return Game::with(['publisher', 'categories'])->get();
    }

    public function searchGamesByTitle(string $title): ?Game
    {
        return Game::where('title', 'Like', "%{$title}%")->first();
    }

    public function getReviews(?Game $game)
    {
        return $game ? $game->reviews()->get()->all() : null;
    }

    public function createReview(Game $game, Review $review)
    {
        $game->reviews()->save($review);
    }

    public function deleteReview(Review $review)
    {
        $review->delete();
    }

}
