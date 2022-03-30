<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\AccountInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccountController extends Controller
{
    public function __construct(
        private AccountInterface $accountInterface
    )
    {}

    public function show(?int $id = null)
    {
        if (is_int($id)) {
            return $this->getWishDetails($id);
        }

        return $this->getWishlist();
    }


    private function getWishlist()
    {
        return view('wishlist', [
            'wish' => $this->accountInterface->getWishlist(),
        ]);
    }

    public function getWishDetails(int $id)
    {
        $wish = $this->accountInterface->getWishById($id);

        if ($wish == null) {
            throw new NotFoundHttpException();
        }
        return view('wish-info', [ 'wish' => $wish]);
    }

}
