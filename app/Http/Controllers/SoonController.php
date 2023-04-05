<?php

namespace App\Http\Controllers;

use App\Models\Soon;
use Illuminate\Http\Request;

class SoonController extends Controller
{
    public function soon()
    {
        $s= Soon::get();

        return response()->json([
            'code'=>200,
            'message'=>'fetch data successfully',
            'data'=>$s
        ]);
    }
}
