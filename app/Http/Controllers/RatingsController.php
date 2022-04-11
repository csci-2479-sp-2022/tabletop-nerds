<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Ratings;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    public function updateRating(Request $req)
    {
        if ($req->ajax()) {
            $data = $req->all();
            $initRating = Ratings::initRating($data['game_id']);
            $ratings = new Ratings;
            if ($initRating == 0) {
                $ratings->game_id = $data['game_id'];
                $ratings->user_id = $data['user_id'];
                $ratings->save();
                return response()->json(['action' => 'rate', 'message' => 'Rating Added Successfully!']);
            } else {
                Ratings::where(['user_id' => Auth::id(), 'game_id' => $data['game_id']])->delete();
                return response()->json(['action' => 'update', 'message' => 'Rating Updated Successfully!']);
            }
        }
    }
}
