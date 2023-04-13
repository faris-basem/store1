<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banner()
    {
        $s= Banner::get(['id','img']);

        return response()->json([
            'code'=>200,
            'message'=>'fetch data successfully',
            'data'=>$s
        ]);
    }

    public function banner_by_id(Request $request)
    {
        $s= Banner::where('id',$request->id)->first();

        return response()->json([
            'code'=>200,
            'message'=>'fetch data successfully',
            'data'=>$s
        ]);
    }
}
