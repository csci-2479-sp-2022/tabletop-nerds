<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\GameInterface;

class SearchResultController extends Controller
{
    public function __construct(
        private GameInterface $gameInterface
    )
    {}
    
    public function show()
    {
        return view(
            'search-results',
            [
                'results' => $this->gameInterface->searchGamesByTitle("test"),
            ]
        );
    }
}
