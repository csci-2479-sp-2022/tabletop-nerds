<?php

namespace Tests\Feature;

use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_form_redirects_if_not_authorized()
    {
        $response = $this->get('/game/1/review');

        $this->assertGuest();
        $response->assertRedirect('/login');
    }

    public function test_show_form()
    {
        $response = $this->actingAs(User::find(1))->get('/game/1/review');

        $response->assertStatus(200);
    }

    public function test_form_has_previous_review_data()
    {
        $userReview = Review::where('user_id', 1)->where('game_id', 1)->first();
        $title = $userReview->title;
        $body = $userReview->body;
        $recommended = $userReview->recommended;

        $response = $this->actingAs(User::find(1))->get('/game/1/review');
        $response->assertViewHasAll([
            'title' => $title, 'body' => $body, 'recommended' => $recommended
        ]);
    }

    public function test_form_post_creates()
    {
        $title = 'Test Title';
        $body = 'Test Body';
        $verdict = 1;

        $response = $this->actingAs(User::find(1))->post('/game/2/review', ['title' => $title, 'body' => $body, 'verdict' => $verdict]);
        

        $review = Review::where('user_id', 1)->where('game_id', 2)->first();
        
        $this->assertModelExists($review);
        $response->assertRedirect('/game/2');
    }


    public function test_form_delete_deletes()
    {
        $review = Review::where('user_id', 1)->where('game_id', 1)->first();
        $response = $this->actingAs(User::find(1))->delete('/game/1/review');
        $this->assertModelMissing($review);
        $response->assertRedirect('/game/1');

    }

    public function test_show_form_invalid_game()
    {
        $response = $this->actingAs(User::find(1))->get('/game/99/review');
        $response->assertStatus(404);
    }

}
