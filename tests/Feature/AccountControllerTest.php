<?php

namespace Tests\Feature;

use App\Contracts\AccountInterface;
use Tests\TestCase;
use Mockery\MockInterface;
use App\Models\Wishlist;
use App\Models\Game;
use App\Models\Review;


class AccountControllerTest extends TestCase
{
    private $wishlist;
    private $games;



    private MockInterface $accountServiceSpy;

    public function setUp(): void
    {
        parent::setUp();
        $this->wishlist = self::getWishlist();
        $this->games = self::getGames();
        $this->accountServiceSpy = $this->spy(AccountInterface::class);
        $this->seed();
    }

    public function getWishlist()
    {
        $user_wishlist = Wishlist::where('user_id', 13)->get()->first();
        return $user_wishlist;
    }

    private static function getGames()
    {
        $game = Game::find(1); //game 1; user 13
        return $game;
    }

    // public function test_get_wishlist_returns_list(): void
    // {
    //     $this->accountServiceSpy->shouldReceive('getUserWishlist')
    //         ->with(13)
    //         ->once()
    //         ->andReturn($this->wishlist);
    //     $response = $this->get('/wishlist');
    //     $response->assertStatus(200);
    //     $response->assertViewHas('wish', $this->games);
    // }

    public function test_get_wishlist_returns_single_game_by_id(): void
    {
        $this->accountServiceSpy->shouldReceive('getWishlistGameById')
            ->with(1)
            ->once()
            ->andReturn($this->games);
        $response = $this->get('/wish/1');
        $response->assertStatus(302);
        $response->assertRedirect('/game/1');
    }


    public function test_get_wishlist_invalid_id(): void
    {
        $falseId = 99;
        $this->accountServiceSpy->shouldReceive('getWishlistGameById')
            ->with($falseId)
            ->andReturn(null);
        $response = $this->get('/game/' . $falseId);
        $response->assertStatus(404);
    }
}
