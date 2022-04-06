<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function userWishlist(){
        $user_id = auth()->guard('user')->user()!= null ? auth()->guard('user')->user()->id : null;
        return $this->hasMany(Wishlist::class, 'id', 'game_id')->where('user_id', $user_id);
    }

    public function categoryList(): string
    {
        $catList = [];

        foreach ($this->categories as $category) {
            array_push($catList, $category['name']);
        }

        return implode(', ', $catList);
    }
}
