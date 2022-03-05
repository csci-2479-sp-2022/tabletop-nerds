<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\AccountInterface;

class AccountController extends Controller
{
    public function __construct(
        private AccountInterface $accountInterface
    )
    {}

    public function show() {
        return view(
            'wishlist',
            [
                'wish' => $this->accountInterface->getWishlist(),
            ]
            );
    }

    public function view (int $id) {
        return view('wish-info', [ 'wish' => $this->accountInterface->getWishlistByUserId($id) ]);
    }

}
