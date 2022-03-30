<?php

namespace Tests\Feature;

use App\Contracts\GameInterface;
use App\Services\GameService;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery\MockInterface;
use App\Models\Game;

class GameControllerTest extends TestCase
{

    private  array $games;

    private MockInterface $gameServiceSpy;

    private static function getGames()
    {
        $gameCollection = Game::all();

        return $gameCollection->all();
    }



    public function setUp(): void
    {
        parent::setUp();

        $this->games = self::getGames();

        $this->gameServiceSpy = $this->spy(GameInterface::class);

        $this->seed();
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
        $this->gameServiceSpy->shouldReceive('getGameById')
            ->with(1)
            ->once()
            ->andReturn(
                $this->games[0]
            );

        //act
        $response = $this->get('/game/1');

        //assert
        $response->assertStatus(200);
        $response->assertViewHas(
            'game',
            $this->games[0]
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
