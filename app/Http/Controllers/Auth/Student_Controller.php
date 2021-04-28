<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Student_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:student']);
    }

    public function Student(Request $request){
        $student=$request->user();
        return response()->json([
            'id'=>$student->id,
            'fullname'=>$student->fullname,
            'uid'=>$student->uid
        ]);

    }
}
