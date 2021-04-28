<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    public function Admin(Request $request)
    {
        $user=$request->user();
        return response()->json([
            'id'=>$user->id,
            'Username'=>$user->Username,
            'role'=>$user->role,
        ]);
    }
}
