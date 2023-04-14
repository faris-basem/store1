<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $table = 'games';
    protected $guarded = [];
    public $timestamps=false;



    protected $appends = ['GameCountry','Review'];
    
    function getGameCountryAttribute(){
        $Game_country = GameCountry::where('game_id',$this->id)->get();
        return $Game_country;
    }
    function getReviewAttribute(){
        $Game_country = Review::where('game_id',$this->id)->get();
        return $Game_country;
    }
}
