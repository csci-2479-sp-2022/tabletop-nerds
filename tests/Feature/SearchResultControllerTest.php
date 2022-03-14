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
    // public function test_the_application_returns_a_successful_response()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }


    private static function getSearchResult() {
        return [
            
            SearchResult::make(['name' => 'Test search 1!', 'id' => 1])
            
        ];
    } // end get

    protected function setUp(): void {

        parent::setUp();
        
        $this -> searchResult = self::getSearchResult();

       $this->gameServiceSpy = $this -> spy(GameInterface::class);

    } // end setUp

    public function test_getSearchResult_list() {
        
        //arrange 
        $this -> gameServiceSpy -> shouldReceive('searchGamesByTitle')
        ->once()
        ->andReturn(
            $this -> searchResult 
        );
        
        //act
        $response = $this -> get('/search-results');
        
        //Assert 
        $response -> assertStatus(200);
        $response -> assertViewHas(
            'results',
                $this -> searchResult
        );
    } //end List Test

    public function test_get_post_redirect() {
        
        //arange
        $this -> gameServiceSpy -> shouldReceive('getSearchResultById')
        ->once()
        ->andReturn(
            $this -> searchResult
        );

        //act 
        $response = $this -> get('/SearchResult/1');

        //Assert
        $response -> assertStatus(200);
        $response -> assertViewHas(
            'SearchResult',
                SearchResult::make([
                    'id' => 1,
                    'name' => 'monopoly',
                    
                ]),
        );
    } // end Id Test


} // end


