<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\MailFaris;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function regester(Request $request)
    {
        
        $usere = User::where('email',$request->email)->first();
        $userp = User::where('phone',$request->phone)->first();
        if($usere)
        {
        $ran=rand(1000, 9999);
        $usere->email_code=$ran;
        $usere->save();
        //code sent
        }elseif($userp){
        // $ran=rand(1000, 9999);
        // $usere->phone_code=$ran;
        // $usere->save();
        //code sent
        }elseif($request->email){
            $user=new User();
            $user->email =  $request->email;
            $user->save();
            //send code
        }else{
            $user=new User();
            $user->phone =  $request->phone;
            $user->save();
            //send code
        }


        
    }
        public function send()
        {
            $random=1111;
            Mail::to("gonegamer11@gmail.com")->send(new MailFaris($random));
            return response()->json([
                'code'=>200,
                'message'=>'Email sent successffuly',
            ]);
        }
}
