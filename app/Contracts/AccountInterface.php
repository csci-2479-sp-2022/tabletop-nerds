<?php

namespace App\Contracts;

use App\Models\Wishlist;


interface AccountInterface
{

    function getWishlist(string $orderBy='title', bool $direction= false, int $limit=20): array;

    function getWishlistByUserId(int $id): Wishlist;

}
