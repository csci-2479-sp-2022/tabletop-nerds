<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Publisher;

class Game extends Model
{
    use HasFactory;

    public function publishers()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
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
