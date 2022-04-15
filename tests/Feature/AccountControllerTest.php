<?php

namespace Tests\Feature;

use App\Contracts\AccountInterface;
use Tests\TestCase;
use Mockery\MockInterface;
use App\Models\Wishlist;
use App\Models\Game;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountControllerTest extends TestCase
{
    use RefreshDatabase;

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
        $user_wishlist = Wishlist::where('user_id', 13)->get();
        return $user_wishlist;
    }

    private function getGames()
    {
        $games = [];
        foreach ($this->wishlist as $wish) {
            $game = $wish->game()->get()[0];
            array_push($games, $game);
        }
        return $games;
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
    public function test_get_wishlist_returns_list(): void
    {
         $this->accountServiceSpy->shouldReceive('getUserWishlist')
             ->with(1)
             ->once()
             ->andReturn($this->wishlist);
        $response = $this->actingAs(User::find(1))->get('/wishlist');
        $response->assertStatus(200);
        $response->assertViewHas('wish', $this->games);
    }
}
