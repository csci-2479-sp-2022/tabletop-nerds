<?php

namespace App\Http\Controllers;

use App\Contracts\GameInterface;
use App\Models\Game;
use App\Models\Review;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ReviewController extends Controller
{
    public function __construct(
        private GameInterface $gameInterface
    ) {}

    public function show(Request $request, $id){

        //arrange data
        $userId = $request->user()->id;
        $userReview = Review::where('user_id', $userId)->where('game_id', $id)->first();
        $title = $body = $recommended = "";
        
        //throw 404 if no game exists
        Game::find($id) ? $gameTitle = Game::find($id)->title: throw new NotFoundHttpException();
        
        //check if review exists and arrange more data
        if($userReview){
            $title = $userReview->title;
            $body = $userReview->body;
            $recommended = $userReview->recommended;
        }

        return view('review-form', ['id' => $id, 'title' => $title, 'body' => $body, 'recommended' => $recommended, 'gameTitle' => $gameTitle]);
    }

    public function create(Request $request, $id)//update or create
    {
        //arrange data
        $user = $request->user();
        $userId = $user->id;
        $game = $this->gameInterface->getGameById($id);

        //create new Review or update if a Review already exists
        $review = Review::where('user_id', $userId)->where('game_id', $id)->first() ?? new Review;
        $review->title = $request->title;
        $review->body = $request->body;
        $review->recommended = $request->verdict;
        $review->user_id = $userId;

        $this->gameInterface->createReview($game, $review);
        
        //redirect back to game info page
        return redirect()->route('game-info', ['id' => $id]);

    }

    public function delete(Request $request, $id)
    {  
        //arrange data
        $userId = $request->user()->id;
        $review = Review::where('user_id', $userId)->where('game_id', $id)->first();
        $this->gameInterface->deleteReview($review);

        //redirect back to game info page
        return redirect()->route('game-info', ['id' => $id]);
    }
}
