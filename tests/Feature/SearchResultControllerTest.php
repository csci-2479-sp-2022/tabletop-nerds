<?php

namespace Tests\Feature;

use App\Contracts\GameInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\SearchResult;
use App\Contracts\SearchResultService;
use App\Services\GameService;
use Mockery\MockInterface;


use Tests\TestCase;

class SearchResultControllerTest extends TestCase
{

    
    private MockInterface $gameServiceSpy; 
    private array $searchResult; 

    // /**
    //  * A basic test example.
    //  *
    //  * @return void
    //  */
  
    private static function getSearchResult()
    {
        $searchGame = Game::where('title', 'LIKE', 'Monopoly');
        return $searchGame->first();
    } // end get

    protected function setUp(): void
    {
        parent::setUp();

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
        $response->assertStatus(200);
        $response->assertViewHas(
            'game',
            $this->searchResult
        );
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

    public function test_post_search_result()
    {
        //act
        $response = $this->call('POST', '/search-results');

        //Assert
        $response->assertRedirect('/search-results');
    } // end post Test

} // end
