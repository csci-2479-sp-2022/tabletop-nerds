<?php

namespace App\Http\Controllers;

use App\Contracts\AccountInterface;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Ratings;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    public function __construct(
        private AccountInterface $accountInterface
    ) {}

    public function updateRating(Request $req)
    {
        if ($req->ajax()) {
            $data = $req->all();
            $initRating = Ratings::initRating($data['game_id']);
            $game_id = $data['game_id'];
            $user_id = $data['user_id'];
            $ratings = $this->accountInterface->getUserRating($user_id, $game_id) ?? new Ratings;
            
            $ratings->game_id = $data['game_id'];
            $ratings->user_id = $data['user_id'];
            $ratings->game_rating = $data['rated'];
            $ratings->save();
            return response()->json(['action' => 'rate', 'message' => 'Rating Added Successfully!']);
            
        }
    }
}
