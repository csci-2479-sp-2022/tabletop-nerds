<?php

namespace App\Http\Controllers;

use App\Contracts\AccountInterface;
use Illuminate\Http\Request;
use App\Contracts\GameInterface;
use App\Models\Review;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GameController extends Controller
{
    public function __construct(
        private GameInterface $gameInterface, 
        private AccountInterface $accountInterface
    )
    {}

    public function showGameList()
    {
        return view('game-list', [
            'games' => $this->gameInterface->getGames(),
        ]);
    }

    public function showGame(Request $request, $id)
    {
        $game = $this->gameInterface->getGameById($id);
        $reviews = $this->gameInterface->getReviews($game);
        $user = $request->user();
        $user ? $user = $user->id : $user = null; //login check
        $reviewed = Review::where('user_id', $user)->where('game_id', $id)->first() ? true : false;
        $userRating = $this->accountInterface->getUserRating($user, $id);
        $userRating ? $userRating = $userRating->game_rating : null;
        $game ?? throw new NotFoundHttpException();

        return view('game-info', [ 'game' => $game, 'reviews' => $reviews, 'reviewed' => $reviewed, 'userRating' => $userRating]);
    }

}
