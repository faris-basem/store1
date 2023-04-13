<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameCountry extends Model
{
    use HasFactory;
    protected $table = 'games_countries';
    protected $guarded = [];
    public $timestamps=false;
}