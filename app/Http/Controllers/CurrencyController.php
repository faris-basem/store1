<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function all_currencies()
    {
        $a=Currency::get();
        return response()->json([
            'code'=>200,
            'message'=>'gg',
            'data'=>$a
            ]);
    }
}
