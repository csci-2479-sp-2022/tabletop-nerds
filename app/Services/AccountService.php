<?php

namespace App\Services;

use App\Contracts\AccountInterface;
use App\Models\Wishlist;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;



class AccountService implements AccountInterface
{
    public function getUserWishlist(int $user_id)
    {
        $user_wishlist = Wishlist::where('user_id', $user_id)->get();
        $games = [];
        foreach ($user_wishlist as $wish) {
            $game = $wish->game()->get()[0];
            array_push($games, $game);
        }
        return $games;
    }


    public function getWishlistById(int $id)
    {

        foreach (self::getUserWishlist(Auth::id()) as $game) {
            if ($game->id === $id) {
                $reviews =  $game->reviews()->get();
                return ['game' => $game, 'reviews' => $reviews];
            }
        }
        return null;
    }
}
