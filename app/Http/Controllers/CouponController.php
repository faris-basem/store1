<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function generate(Request $request)
    {
        $n=$request->num;
        for($i=0;$i<$n;$i++){
            $gen=Str::random(5).'-'.Str::random(5).'-'.Str::random(5);
            $g=new Coupon();
            $g->game_id=$request->game_id;
            $g->package_id=$request->package_id;
            $g->code=$gen;
            $g->save();
        }
        return response()->json([
            'code'=>200,
            'message'=>$n.'codes added successfully',
        ]);
    }
    
}
