<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Game;
use App\Models\Review;
use App\Models\GameCountry;
use App\Models\Package;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function games()
    {
        $s= Game::get();

        return response()->json([
            'code'=>200,
            'message'=>'fetch data successfully',
            'data'=>$s
        ]);
    }
    public function game_by_id(Request $request)
    {
        $game= Game::where('id',$request->id)->first();
        $reviews=Review::where('game_id',$request->id)->get(['name','rate','comment']);
        $gc=GameCountry::where('game_id',$request->id)->get();
        $countries = [];
        foreach($gc as $cf){
        $c=Country::where('id',$cf->country_id)->first(['name','currency']);
        $countries []=$c;

    }
        return response()->json([
            'code'=>200,
            'message'=>'fetch data successfully',
            'game'=>$game,
            'rates'=>$reviews,
            'countries'=>$countries
        ]);
    }

    public function packages(Request $request)
    {
        $pack=Package::where('game_id', $request->game_id)->where('country_id',$request->country_id)->first(['quantity','name']);
        $game=Game::where('id',$request->game_id)->first('name');
        $country=Country::where('id',$request->country_id)->first('name');
        return response()->json([
            'code'=>200,
            'message'=>'fetch data successfully',
            'game'=>$game,
            'package'=>$pack,
            'country'=>$country
        ]);
    }


    public function search(Request $request)
    {
        $search=Game::where('name','like','%'.$request->name.'%')->get();
        if($search->count()>0){
            return response()->json([
                'code'=>200,
                'message'=>'fetch data successfully',
                'data'=>$search
                ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'no data found'
                ]);
        }
    }
}
