<?php

namespace App\Contracts;

use App\Models\Game;
use App\Models\Review;

interface GameInterface
{

    function getGameById(int $id): ?Game;

    function getGames();

    function searchGamesByTitle(string $title): ?Game;

    function getReviews(?Game $game);

    function createReview(Game $game, Review $review);

    function deleteReview(Review $review);

}
