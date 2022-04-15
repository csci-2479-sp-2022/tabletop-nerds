<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Ratings extends Model
{
    use HasFactory;

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function initRating($game_id){
        $initRating = Ratings::where(['user_id' => Auth::user()->id, 'game_id'=> $game_id])->count();
        return $initRating;
    }
}
