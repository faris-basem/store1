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


    protected $appends = ['Packeges'];
    
    function getPackegesAttribute(){
        $Game_country = Package::where('game_id',$this->game_id)->where('country_id',$this->country_id)->get();
        return $Game_country;
    }
}
