<?php

namespace App\Contracts;

use App\Models\Game;
use App\Models\SearchResult;

interface GameInterface
{
    function getGameById(int $id): Game;

    function getGames(string $orderBy='title', bool $direction= false, int $limit=20): array;

    function searchGamesByTitle(string $title): array;
}