<?php

namespace Tests\Feature;

use App\Contracts\GameInterface;
use Tests\TestCase;
use Mockery\MockInterface;
use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameControllerTest extends TestCase
{
    use RefreshDatabase;

    private  array $games;

    private MockInterface $gameServiceSpy;

    private static function getGames()
    {
        $gameCollection = Game::all();

        return $gameCollection->all();
    }

    private static function getReviews($game)
    {
        $reviewCollection = $game->reviews()->get();
        return $reviewCollection->all();
    }


    public function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->games = self::getGames();

        $this->gameServiceSpy = $this->spy(GameInterface::class);


    }

    public function test_get_games()
    {
        //arrange
        $this->gameServiceSpy->shouldReceive('getGames')
            ->once()
            ->andReturn($this->games);

        //act
        $response = $this->get('/games');
        //assert
        $response->assertStatus(200);
        $response->assertViewHas(
            'games',
            $this->games
        );
    }

    public function test_get_game_by_id()
    {
        //arrange
        $game = $this->games[0];
        $this->gameServiceSpy->shouldReceive('getGameById')
            ->with(1)
            ->once()
            ->andReturn(
                $game
            );

        $this->gameServiceSpy->shouldReceive('getReviews')
            ->with($this->games[0])
            ->once()
            ->andReturn(
                $this->getReviews($game)
            );

        //act
        $response = $this->get('/game/1');

        //assert
        $response->assertStatus(200);
        $response->assertViewHas(
            'game', $this->games[0]

        );
    }

    public function test_get_game_with_invalid_id()
    {
        $this->gameServiceSpy->shouldReceive('getGameById')
            ->with(99)
            ->once()
            ->andReturn(
                null
            );
        $response = $this->get('/game/99');
        $response->assertStatus(404);
    }
}
