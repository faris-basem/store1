<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Review;
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
        $reviews=Review::where('game_id',$request->id)->get();

        return response()->json([
            'code'=>200,
            'message'=>'fetch data successfully',
            'data'=>$game,$reviews
        ]);
    }
}
