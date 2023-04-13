<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\MailFaris;
use App\Models\Cart;
use App\Models\Favourite;
use App\Models\Game;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function login(Request $request)
    {
        
        if(isset($request->phone)){

            if(isset($request->email)){
                $usere = User::where('email',$request->email)->first();
                $usere->phone=$request->phone;
                // $ran=rand(1000, 9999);
                // $usere->phone_code=$ran;
                 $usere->save();
                //code sent
                $usere['token'] = $usere->createToken('accessToken')->accessToken;
                return response()->json([
                    'code'=>200,
                    'message'=>'Phone and Email',
                    'data'=>$usere
                ]);
    
            }
            $userp = User::where('phone',$request->phone)->first();
            if($userp){
            // $ran=rand(1000, 9999);
            // $usere->phone_code=$ran;
            // $usere->save();
            //code sent
            return response()->json([
                'code'=>200,
                'message'=>'Phone Login',
            ]);
        }else{
            $user=new User();
            $user->phone =  $request->phone;
            // $user->name = $request-> name;
            $user->save();
            //send code
            return response()->json([
                'code'=>200,
                'message'=>'Phone Register',
            ]);
        }
        }elseif(isset($request->email)){
            $usere = User::where('email',$request->email)->first();
            
            if($usere)
            {
            $ran=rand(1000, 9999);
            $usere->email_code=$ran;
            $usere->save();
    
            $s=$request->email;
            Mail::to ($s)->send(new MailFaris($ran));
            return response()->json([
                'code'=>200,
                'message'=>'Email Login',
            ]);
            
            }else{
                $random=rand(1000, 9999);
                $user=new User();
                $user->email =  $request->email;
                $user->email_code=$random;
                // $user->name = $request-> name;
                $user->save();
                $s=$request->email;
            Mail::to ($s)->send(new MailFaris($random));
            return response()->json([
                'code'=>200,
                'message'=>'Email Register',
            ]);
            }
        }        
    }
    public function verify(Request $request)
    {
        if (isset($request->phone_code)){
            $user=User::where('phone',$request->phone)->first();
            if($user->phone_code==$request->phone_code){
                $user['token'] = $user->createToken('accessToken')->accessToken;
                return response()->json([
                    'code'=>200,
                    'message'=>'Phone Verify',
                    'data'=>$user
                ]);
            }
            else{
                return response()->json([
                    'code'=>400,
                    'message'=>'Phone Verify Error',
                ]);
                }
        }elseif(isset($request->email_code)){
            $user=User::where('email',$request->email)->first();
            if($user->email_code==$request->email_code){
                return response()->json([
                    'code'=>200,
                    'message'=>'fetch data successfully',
                ]);
            

        }else{
            return response()->json([
                'code'=>400,
                'message'=>'Email Verify Error',
            ]);
        }
        }

    }
    public function add_fav(Request $request)
    {
        $is_fav=Favourite::where('user_id',Auth::guard('api')->user()->id)->where('game_id',$request->game_id)->first();
        if($is_fav){
            $is_fav->delete();
            return response()->json([
                'code'=>200,
                'message'=>'game removed from favorite',
            ]);
        }
        $fg=new Favourite() ;
        $fg->user_id=Auth::guard('api')->user()->id;
        $fg->game_id=$request->game_id;
        $fg->save();
        return response()->json([
            'code'=>200,
            'message'=>'game added to favorite',
        ]);
    }

    public function favorite_games()
    {
        $fg=Favourite::where('user_id',Auth::guard('api')->user()->id)->get();
        $games = [];
        foreach($fg as $cf){
        $c=Game::where('id',$cf->game_id)->first('name');
        $games []=$c;

    }

        return response()->json([
            'code'=>200,
            'message'=>'fetch data succsessfully',
            'data'=>$games
        ]);
    }

    public function cart(Request $request)
    {
        $my_cart=Cart::where('user_id',Auth::guard('api')->user()->id)->get();
        $games = [];
        foreach($my_cart as $cf){
        $c=Game::where('id',$cf->game_id)->first('name');
        $games []=$c;
         }
        return response()->json([
            'code'=>200,
            'message'=>'fetch data succsessfully',
            'data'=>$games
            ]);
    }
    public function add_to_cart(Request $request)
    {
        $is_add=Cart::where('user_id',Auth::guard('api')->user()->id)->where('game_id',$request->game_id)->first();
        if($is_add){
            $is_add->delete();
            return response()->json([
                'code'=>200,
                'message'=>'game removed from cart',
            ]);
        }
        $fg=new Cart() ;
        $fg->user_id=Auth::guard('api')->user()->id;
        $fg->game_id=$request->game_id;
        $fg->save();
        return response()->json([
            'code'=>200,
            'message'=>'game added to cart',
        ]);
    }

        // public function send()
        // {
        //     $random=rand(1000, 9999);

        //     Mail::to("gonegamer11@gmail.com")->send(new MailFaris($random));
        //     return response()->json([
        //         'code'=>200,
        //         'message'=>'Email sent successffuly',
        //     ]);
        // }
}
