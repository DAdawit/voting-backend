<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\su_Memeber;

class SU_MemebersController extends Controller
{
    public function memebers(){
        $memebers=su_Memeber::all();
        return $memebers;
    }

    public function store(Request $request){
        $lastmemeber=su_Memeber::all()->last();
        $memeber=new su_Memeber();
        $memeber->fullname=$request->fullname;
        $memeber->department=$request->department;
        $memeber->college=$request->college;
        $memeber->sex=$request->sex;
        $memeber->suid=$lastmemeber->suid+1;
        $memeber->id_number=$request->id_number;
        $memeber->save();
        return response()->json('success',200);
    }

    public function update($id,Request $request){
        $memeber=su_Memeber::find($id);
        $memeber->fullname=$request->fullname;
        $memeber->department=$request->department;
        $memeber->college=$request->college;
        $memeber->sex=$request->sex;
        $memeber->id_number=$request->id_number;
        $memeber->update();
        return response()->json('success',200);
    }
    public function destroy($id){
        $memeber=su_Memeber::find($id);
        $memeber->delete();
    }

}
