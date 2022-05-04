<?php

namespace App\Services;

use App\Contracts\GameInterface;
use App\Http\Requests\AddCategory;
use App\Http\Requests\AddGame;
use App\Models\Category;
use App\Models\Game;
use App\Models\Publisher;
use App\Models\Review;

class GameService implements GameInterface
{
    public function addGame(AddGame $request)
    {
        $validated = $request->validated();
        $game = new Game;
        $game->title = $validated['title'];
        $game->complexity_rating = $validated['complexity_rating'];
        $game->cost = $validated['cost'];
        $game->release_year = $validated['release_year'];
        $game->playing_time_minutes = $validated['playing_time_minutes'];
        $game->min_number_players = $validated['min_number_players'];
        $game->max_number_players = $validated['max_number_players'];
        $game->description = $validated['description'];
        $game->img_url = $validated['img_url'];
        $game->publisher()->associate($validated['publisher_id']);
        $game->save();
        if($request->category)
        {
            foreach($request->category as $category){
                $game->categories()->attach($category);
            }
        }
    }
    public function getGameById(int $id): ?Game
    {
        return Game::find($id);
    }

    public function getGames()
    {
        return Game::with(['publisher', 'categories'])->get();
    }

    public function searchGamesByTitle(string $input)
    {
        return Game::with(['publisher', 'categories'])
        ->where('title', 'Like', "%{$input}%")->get();
        // We can also include the bellow condition if we want to search by game description too.
        //->orWhere('description', 'Like', "%{$input}%" )->get();
    }

    public function getReviews(?Game $game)
    {
        return $game ? $game->reviews()->get()->all() : null;
    }

    public function createReview(Game $game, Review $review)
    {
        $game->reviews()->save($review);
    }

    public function deleteReview(Review $review)
    {
        $review->delete();
    }

    public function getPublishers()
    {
        return Publisher::all();
    }

    public function getCategories()
    {
        return Category::all();
    }

    public function addCategory(AddCategory $request)
    {
        $validated = $request->validated();
        $category = new Category;
        $category->name = $validated['name'];
        $category->code = $validated['code'];
        $category->save();
    }

    public function addPublisher(AddCategory $request)
    {
        $validated = $request->validated();
        $publisher = new Publisher;
        $publisher->name = $validated['name'];
        $publisher->code = $validated['code'];
        $publisher->save();

    }
}
