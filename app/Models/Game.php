<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'img_url',
        'type',
        'publication',
        'description',
        'rating',
        'complexity',
        'cost',
        'boxArt',
    ];
}
