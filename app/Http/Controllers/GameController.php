<?php

namespace App\Http\Controllers;

use App\Contracts\AccountInterface;
use Illuminate\Http\Request;
use App\Contracts\GameInterface;
use App\Http\Requests\AddCategory;
use App\Http\Requests\AddGame;
use App\Models\Review;
use App\Models\Ratings;
use Illuminate\Support\Facades\Gate;
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
        $averageGameRating = $this->accountInterface->getAverageRatingOfGame($id);
        $userRating ? $userRating = $userRating->game_rating : null;
        $game ?? throw new NotFoundHttpException();

        return view('game-info', [ 'game' => $game, 'reviews' => $reviews, 'reviewed' => $reviewed, 'userRating' => $userRating, 'averageRating' => $averageGameRating]);
    }

    public function addGame(AddGame $request)
    {
        // $validated = $request->validated();
        // return view('add-game-form', ['reqdata' => $validated]);
        $this->gameInterface->addGame($request);
        return redirect()->route('games');
    }

    public function addGameForm(Request $request)
    {
        Gate::denyIf(!$request->user()->is_admin);
        return view('add-game-form', 
        [
            'publishers' => $this->gameInterface->getPublishers(),
            'categories' => $this->gameInterface->getCategories(),
        ]);
    }

    public function addPublisher(AddCategory $request)
    {
        $this->gameInterface->addPublisher($request);
        return redirect()->route('games');
    }
    public function addPublisherForm(Request $request)
    {
        Gate::denyIf(!$request->user()->is_admin);
        return view('add-publisher-form');
    }

    public function addCategory(AddCategory $request)
    {
        $this->gameInterface->addCategory($request);
        return redirect()->route('games');

    }
    public function addCategoryForm(Request $request)
    {
        Gate::denyIf(!$request->user()->is_admin);
        return view('add-category-form');
    }
}
