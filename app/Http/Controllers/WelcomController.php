<?php

namespace App\Http\Controllers;

use App\Models\Welcom;
use Illuminate\Http\Request;

class WelcomController extends Controller
{
    public function welcome()
    {
        $s= Welcom::get();

        return response()->json([
            'code'=>200,
            'message'=>'fetch data successfully',
            'data'=>$s
        ]);
    }
}
