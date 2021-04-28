<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function Me(Request $request)
    {
        $user=$request->user();
        return response()->json([
            'id'=>$user->id,
            'Username'=>$user->Username,
            'suid'=>$user->suid,
            'role'=>$user->role,
            'account_status'=>$user->account_status
        ]);
    }

}
