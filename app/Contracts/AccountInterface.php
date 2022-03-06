<?php

namespace App\Contracts;

use App\Models\Wishlist;


interface AccountInterface
{
    function  getWishById(int $id): Wishlist;

    function getWishlistByUserId(int $id): Wishlist;

    function getWishlist(string $orderBy='title', bool $direction= false, int $limit=20): array;

}
