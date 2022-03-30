<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\GameInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SearchResultController extends Controller
{
    public function __construct(
        private GameInterface $gameInterface
    ) {
    }

    public function show()
    {
        $search = request()->query('game');

        if ($search === null) {
            return view(
                'search-results',
                ['result' => $search]
            );
        }
        return $this->searchGameDetails($search);
    }


    public function searchGameDetails(string $title)
    {
        $game = $this->gameInterface->searchGamesByTitle($title);
        if ($game === null) {
            return view(
                'search-results',
                ['result' => $title]
            );
        } else {
            return view(
                'game-info',
                ['game' => $game]
            );
        }
    }
}
