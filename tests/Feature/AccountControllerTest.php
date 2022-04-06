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
    private $game;
    private $reviews;



    private MockInterface $accountServiceSpy;

    public function setUp(): void
    {
        parent::setUp();
        $this->wishlist = self::getWishlist(13);
        $this->game = self::getGames();
        $this->accountServiceSpy = $this->spy(AccountInterface::class);
    }

    public function getWishlist(int $user_id)
    {
        $user_wishlist = Wishlist::where('user_id', $user_id)->get();
        $games = [];
        foreach ($user_wishlist as $wish) {
            $game = $wish->game()->get()[0];
            array_push($games, $game);
        }
        return $games;
    }

    private static function getGames()
    {
        $game = Game::where('id', 1)->get()[0]; //game 1; user 13
        return $game;
    }

    private static function getReviews($game)
    {
        $reviewCollection = $game->reviews()->get();
        return $reviewCollection->all();
    }


    public function test_get_wishlist_returns_list(): void
    {
        $this->accountServiceSpy->shouldReceive('getUserWishlist')
            ->with(13)
            ->once()
            ->andReturn($this->wishlist);
        $response = $this->get('/wishlist');
        $response->assertStatus(200);
        $response->assertViewHas('wish', $this->wishlist);
    }



    public function test_get_wishlist_returns_single_item_id(): void
    {
        $id = 1;
        $game = $this->wishlist;
        $this->accountServiceSpy->shouldReceive('getWishlistGameById')
            ->with(1)
            ->once()
            ->andReturn();
        $response = $this->get('/wish/1');
        $response->assertStatus(200);
        $response->assertViewHas('wish-info', $game);
    }



    public function test_get_wishlist_invalid_id(): void
    {
        $falseId = 5;
        $this->accountServiceSpy->shouldReceive('getWishlistGameById')
            ->with($falseId)
            ->andReturn(null);
        $response = $this->get('/wish/' . $falseId);
        $response->assertStatus(404);
    }
}
