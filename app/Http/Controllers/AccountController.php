<?php

namespace App\Http\Controllers;

use App\Contracts\AccountInterface;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct(
        private AccountInterface $accountInterface
    ) {
    }

    public function show(?int $id = null)
    {
        if (is_int($id)) {
            return $this->getWishGameDetails($id);
        }
        return $this->getWishlistGames();
    }

    private function getWishlistGames()
    {
        $user_wishlist = $this->accountInterface->getUserWishlist(Auth::id());
        $games = [];
        foreach ($user_wishlist as $wish) {
            $game = $wish->game()->get()[0];
            array_push($games, $game);
        }
        return view('wishlist', [
            'wish' => $games
        ]);
    }

    public function getWishGameDetails(int $id)
    {
        $game = $this->accountInterface->getWishlistGameById($id);
        return redirect()->route('game-info', ['id' => $game->id]);
    }
}
