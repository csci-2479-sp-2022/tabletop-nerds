<?php

namespace Tests\Feature;

use App\Contracts\GameInterface;
use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;

use Tests\TestCase;

class SearchResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private MockInterface $gameServiceSpy;

    private $searchResult;

    private static function getSearchResult()
    {
        $searchGame = Game::where('title', 'LIKE', 'Monopoly');
        return $searchGame->first();
    } // end get

    private static function getReviews($game)
    {
        $reviewCollection = $game->reviews()->get();
        return $reviewCollection->all();
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->searchResult = self::getSearchResult();

        $this->gameServiceSpy = $this->spy(GameInterface::class);
    } // end setUp

    public function test_get_search_result()
    {
        //arrange
        $this->gameServiceSpy->shouldReceive('searchGamesByTitle')
            ->with('Monopoly')
            ->once()
            ->andReturn(
                $this->searchResult
            );
        //act
        $response = $this->get('/search-results?game=Monopoly');
        //Assert
        $response->assertStatus(302);
        $response->assertRedirect('/game/2');
    } //end get Test

    public function test_get_invalid_game_search_result()
    {
        //arrange
        $this->gameServiceSpy->shouldReceive('searchGamesByTitle')
            ->with('invalid')
            ->once()
            ->andReturn(
                null
            );
        //act
        $response = $this->get('/search-results?game=invalid');
        //Assert
        $response->assertStatus(200);
        $response->assertViewHas(
            'result',
            'invalid'
        );
    } //end search invalid game Test
} // end
