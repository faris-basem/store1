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
        return response()->json([
            'code'=>200,
            'message'=>'fetch data successfully',
            'game'=>$game,
        ]);
    }

    public function search(Request $request)
    {
        
        $search=Game::query();
        if($request->has('name')){
        $search->where('name','like','%'.$request->name.'%');
        }
        if($request->has('description')){
        $search->where('description','like','%'.$request->description.'%');
        }
        if($request->has('price')){
        $search->where('price','<=',$request->price);
        }
        
        $results=$search->get();
                
        if($search->count()>0){
            return response()->json([
                'code'=>200,
                'message'=>'fetch data successfully',
                'data'=>$results
                ]);
        }else{
            return response()->json([
                'code'=>404,
                'message'=>'no data found'
                ]);
        }
    }
}
