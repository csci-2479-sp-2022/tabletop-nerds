<?php

namespace Tests\Feature;

use App\Services\AccountService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery\MockInterface;
use App\Models\Wishlist;


class AccountControllerTest extends TestCase
{
    private array $wishlist;

    private MockInterface $accountServiceSpy;

    public function setUp(): void {
        parent::setUp();
        $this->wishlist = self::getWishlist();
        $this->accountServiceSpy = $this->spy(AccountService::class);
    }

    private static function getWishlist() {
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



    public function test_get_wishlist_returns_list():void {
        // arrange
        $this->accountServiceSpy->shouldReceive('getWishlist')
            ->once()
            ->andReturn($this->wishlist);
        // act
        $response = $this->get('/wishlist');
        // assert
        $response->assertStatus(200);
        $response->assertViewHas('wish', $this->wishlist);
    }

    public function test_get_wishlist_returns_single_item_id(): void{
        // arrange
        $id = 1;
        $macbook = $this->wishlist[0];
        $this->accountServiceSpy->shouldReceive('getWishById')
            ->once()
            ->andReturn($macbook);
        // act
        $response = $this->get('/wish/'.$id);
        // assert
        $response->assertStatus(200);
        $response->assertViewHas('wish', $macbook);
    }

    public function test_get_wishlist_invalid_id(): void {
        $falseId = 5;
        $this->accountServiceSpy->shouldReceive('getWishById')
            ->with($falseId)
            ->andReturn(null);
        $response = $this->get('/wish/' . $falseId);
        $response->assertStatus(404);
    }
}
