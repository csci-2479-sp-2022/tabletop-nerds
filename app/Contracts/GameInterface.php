<?php

namespace App\Contracts;

use App\Models\Game;
use Laravel\Sail\Console\Publisher;
use App\Models\SearchResult;

interface GameInterface
{

    function getGameById(int $id): ?Game;

    function getGames();

    function searchGamesByTitle(string $title): array;

}
