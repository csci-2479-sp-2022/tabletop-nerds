<?php

namespace App\Services;

use App\Contracts\AccountInterface;
use App\Models\Wishlist;


class AccountService implements AccountInterface
{
    public function getWishlistByUserId(int $id): ?Wishlist
    {
        foreach (self::getWishlist() as $wish) {

            if ($wish->user_id === $id) {
                return $wish;
            }
        }
        return null;
    }

    public function getWishById(int $id): ?Wishlist
    {
        foreach (self::getWishlist() as $wish) {

            if ($wish->id === $id) {
                return $wish;
            }
        }
        return null;
    }

    public function getWishlist(string $orderBy = 'title', bool $direction = false, int $limit = 20):array
     {
        return [
            Wishlist::make ([
                'id' => 1,
                'user_id' => 1,
                'title' => 'Macbook Pro',
                'img_url' => 'https://s.yimg.com/uu/api/res/1.2/927VASDUbq5_kHci3Znbeg--~B/aD0xMjAwO3c9MTgwMDthcHBpZD15dGFjaHlvbg--/https://s.yimg.com/os/creatr-uploaded-images/2020-05/cc201060-8ffe-11ea-aff7-9444289fde6e.cf.jpg',
                'content' => 'I really want a Macbook Pro.'
            ]),
            Wishlist::make ([
                'id' => 2,
                'user_id' => 1,
                'title' => 'Apple',
                'img_url' => 'https://www.applesfromny.com/wp-content/uploads/2020/06/SnapdragonNEW.png',
                'content' => 'Why not want an apple?'
            ])
            ];
    }


}
