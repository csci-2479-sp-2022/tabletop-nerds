<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\GameInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GameController extends Controller
{
    public function __construct(
        private GameInterface $gameInterface
    )
    {}

    public function show(?int $id = null)
    {
        if (is_int($id)) {
            return $this->getGameDetails($id);
        }

        return $this->getGameList();
    }


    private function getGameList()
    {
        return view('game-list', [
            'games' => $this->gameInterface->getGames(),
        ]);
    }



    public function getGameDetails(int $id)
    {
        $game = $this->gameInterface->getGameById($id);

        if ($game == null) {
            throw new NotFoundHttpException();
        }

        return view('game-info', [ 'game' => $game]);
    }

}
