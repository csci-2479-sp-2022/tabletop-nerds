<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\AccountInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Auth;
use App\Models\Game;
use App\Models\Review;

class AccountController extends Controller
{
    public function __construct(
        private AccountInterface $accountInterface
    ) {
    }

    public function show(?int $id = null)
    {
        if (is_int($id)) {
            return $this->getWishDetails($id);
        }
        return $this->getWishlist();
    }


    private function getWishlist()
    {   $games = $this->accountInterface->getUserWishlist(Auth::id());
        return view('wishlist', [
            'wish' => $games
        ]);
    }


    public function getWishDetails(int $id)
    {
        $game = $this->accountInterface->getWishlistById($id);

        if ($game == null) {
            throw new NotFoundHttpException();
        }
        return view('wish-info', $game);
    }
}
