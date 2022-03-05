<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\GameInterface;

class GameController extends Controller
{
    public function __construct(
        private GameInterface $gameInterface
    )
    {}
    
    public function show()
    {
        return view(
            'game-list',
            [
                'games' => $this->gameInterface->getGames(),
            ]
        );
    }

    public function view(int $id)
    {
        return view('game-info', [ 'game' => $this->gameInterface->getGameById($id) ]);
    }

}
