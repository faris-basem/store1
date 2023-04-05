<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banner()
    {
        $s= Banner::get();

        return response()->json([
            'code'=>200,
            'message'=>'fetch data successfully',
            'data'=>$s
        ]);
    }
}
