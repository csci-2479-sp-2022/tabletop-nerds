<?php

namespace App\Contracts;

use App\Models\SearchResult;

interface SearchResultService
{
    public function getSearchResult(): array;

    public function getSearchResultById(int $id): ?SearchResult;
}