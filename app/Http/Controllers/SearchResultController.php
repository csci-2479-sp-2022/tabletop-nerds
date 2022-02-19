<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchResult;

class SearchResultController extends Controller
{
    public function show()
    {
        return view(
            'search-results',
            [
                'results' => self::getSearch(),
            ]
        );
    }

    public function getSearch()
    {
        return [
            SearchResult::make([
                'name' => 'Test search 1!'
            ])
        ];
    }
}
