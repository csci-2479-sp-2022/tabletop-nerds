<?php

namespace App\Contracts;

interface AccountInterface
{
    function getUserWishlist(int $user_id);
    function getWishlistGameById(int $id);
    function getUserRating(?int $user_id, int $game_id);
    function getRatingGameById(int $id);
    function getAverageRatingOfGame(int $id);
}
