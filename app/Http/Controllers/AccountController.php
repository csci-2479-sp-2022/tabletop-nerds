<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show() {
        return view(
            'wishlist',
            [
                'wish' => self::getWishlist(),
            ]
            );
    }

    public function view (int $id) {
        return view('wish-info', [ 'wish' => self::getWishById($id) ]);
    }

    public function getWishById(int $id): Wishlist {
        foreach (self::getWishlist() as $wish) {
            if ($wish->id === $id) {
                return $wish;
            }
        }
        return null;
    }

    public function getWishlist() {
        return [
            Wishlist::make ([
                'id' => 1,
                'title' => 'Macbook Pro',
                'img_url' => 'https://s.yimg.com/uu/api/res/1.2/927VASDUbq5_kHci3Znbeg--~B/aD0xMjAwO3c9MTgwMDthcHBpZD15dGFjaHlvbg--/https://s.yimg.com/os/creatr-uploaded-images/2020-05/cc201060-8ffe-11ea-aff7-9444289fde6e.cf.jpg',
                'content' => 'I really want a Macbook Pro.'
            ]),
            Wishlist::make ([
                'id' => 2,
                'title' => 'Apple',
                'img_url' => 'https://www.applesfromny.com/wp-content/uploads/2020/06/SnapdragonNEW.png',
                'content' => 'Why not want an apple?'
            ])
            ];
    }




}
