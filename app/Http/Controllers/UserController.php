<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\MailFaris;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
                return response()->json([
                    'code'=>200,
                    'message'=>'Phone and Email',
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
