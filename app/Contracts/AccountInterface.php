<?php

namespace App\Contracts;

use App\Models\Wishlist;
use App\Models\Game;
use App\Models\User;


interface AccountInterface
{
    function getUserWishlist(int $user_id);
    function getWishlistById(int $id);

}
