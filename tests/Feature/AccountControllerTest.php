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

    
    public function test_add_rating()
    {
        $user = '1';
        $gameId = '1';
        $rated = '5';

        $response = $this->actingAs(User::find(1))->post('/rate-unrate-game', ['game_id' => $gameId, 'user_id' => $user, 'rated' => $rated]);
        
        $response->assertSuccessful();
        $this->assertDatabaseHas('ratings', ['game_id' => $gameId, 'user_id' => $user, 'game_rating' => $rated]);

    }

    public function test_add_to_wishlist()
    {
        $wish = Wishlist::where('user_id', 1)->where('game_id', 1)->first();
        $wish->delete();
        $response = $this->actingAs(User::find(1))->post('/like-unlike-game', ['game_id' => '1', 'user_id' => '1']);
        
        $response->assertOk();
        $this->assertDatabaseHas('wishlists', ['game_id' => '1', 'user_id' => '1']);
    }

    public function test_delete_from_wishlist()
    {   
        Wishlist::factory()->count(1)->for(Game::find(1))->for(User::find(1))->create();
        $wish = Wishlist::where('user_id', 1)->where('game_id', 1)->first();
        $response = $this->actingAs(User::find(1))->post('/like-unlike-game', ['game_id' => '1', 'user_id' => '1']);
        
        $response->assertSuccessful();
        $this->assertModelMissing($wish);
    }
}
