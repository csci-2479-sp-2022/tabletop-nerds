<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'game_id',
        'title',
        'img_url',
        'content'
    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static function countWishlist($game_id){
        $countWishlist = Wishlist::where(['user_id' => Auth::user()->id, 'game_id'=> $game_id])->count();
        return $countWishlist;
    }
}
