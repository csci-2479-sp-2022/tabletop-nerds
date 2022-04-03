<?php

namespace App\Contracts;

use App\Models\Wishlist;
use App\Models\User;


interface AccountInterface
{
    function  getWishById(int $id): ?Wishlist;

    function getWishlistByUserId(int $id): ?Wishlist;

    function getWishlist();

}
