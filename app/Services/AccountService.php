<?php

namespace App\Services;

use App\Contracts\AccountInterface;
use App\Models\Wishlist;
use App\Models\Game;
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
}
