<?php

namespace App\Contracts;

use App\Http\Requests\AddCategory;
use App\Http\Requests\AddGame;
use App\Models\Game;
use App\Models\Review;

interface GameInterface
{

    function addGame(AddGame $request);

    function getGameById(int $id): ?Game;

    function getGames();

    function searchGamesByTitle(string $input);

    function getReviews(?Game $game);

    function createReview(Game $game, Review $review);

    function deleteReview(Review $review);

    function getPublishers();

    function getCategories();

    function addPublisher(AddCategory $request);

    function addCategory(AddCategory $request);

}
