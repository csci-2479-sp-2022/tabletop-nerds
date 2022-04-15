<?php

namespace App\Services;

use App\Contracts\AccountInterface;
use App\Models\Wishlist;
use App\Models\Game;
use App\Models\Ratings;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class AccountService implements AccountInterface
{
    public function getUserWishlist(int $user_id)
    {
        $user_wishlist = Wishlist::where('user_id', $user_id)->get();
        return $user_wishlist;
    }


    public function getWishlistGameById(int $id)
    {
        return Game::find($id);
    }

    public function getUserRating(?int $user_id, int $game_id)
    {
        $user_rating = Ratings::where('user_id', $user_id)->where('game_id', $game_id)->first();
        return $user_rating;
    }

    public function getRatingGameById(int $id)
    {
        return Game::find($id);
    }

    public function getAverageRatingOfGame(int $id)
    {
        $averageRating = Ratings::where('game_id', $id)->avg('game_rating');

        return number_format((float)$averageRating, 1, '.', '');
    }
}
