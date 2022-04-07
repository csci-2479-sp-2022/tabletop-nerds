<?php

namespace App\Contracts;

interface AccountInterface
{
    function getUserWishlist(int $user_id);
    function getWishlistGameById(int $id);

}
