<?php

namespace App\Contracts;

use App\Models\Game;
use App\Models\Publisher;
use App\Models\SearchResult;

interface GameInterface
{

    function getGameById(int $id): ?Game;

    function getGames();

    function searchGamesByTitle(string $title): ?Game;

    function getReviews(?Game $game);

}
