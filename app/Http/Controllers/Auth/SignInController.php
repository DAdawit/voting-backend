<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SignInController extends Controller
{
    public function SignIn(Request $request)
    {
            if(!$token=auth()->attempt($request->only('Username','password'))){
                return response("unauthorized",401);
            }else{
                return response()->json([
                    'token'=>$token,
                    'role'=>Auth::user()->role
                ]);
            }
    }
    public function AdminLogin(Request $request){
      if(!$token=auth('admin')->attempt($request->only('Username','password'))){
          return response('unauthorized',401);
      }else{
          return response()->json([
              'token'=>$token,
              'role'=>'admin'
          ]);
      }
    }

    public function StudentLogin(Request $request){
        if(!$token=auth('student')->attempt($request->only('fullname','password'))){
            return response()->json('user not found !',400);
        }else{
            return response()->json([
                'token'=>$token,
                'role'=>'voter'
            ]);
        }
    }
}
