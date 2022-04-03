<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function updateWishlist(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $countWishlist = Wishlist::countWishlist($data['game_id']);
            $wishlist = new Wishlist;
            if ($countWishlist == 0) {
                $wishlist->game_id = $data['game_id'];
                $wishlist->user_id = $data['user_id'];
                $wishlist->save();
                return response()->json(['action' => 'like', 'message' => 'Game Added Successfully to Wishlist!']);
            } else {
                Wishlist::where(['user_id' => Auth::id(), 'game_id' => $data['game_id']])->delete();
                return response()->json(['action' => 'unlike', 'message' => 'Game Removed Successfully from Wishlist!']);
            }
        }
    }
}
