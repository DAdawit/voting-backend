<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\vote_count;
use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Election;
use Illuminate\Support\Facades\DB;

class ManageCandidateController extends Controller
{

    public function elections(){
        $elections=Election::all();
        return $elections;
    }
    public function fetchCandidates(){

        $candidates=DB::table('users')
    ->join(	'su__memebers','users.id','=','su__memebers.id')
    ->join('profiles','users.id','=','profiles.user_id')
    ->join('candidates','candidates.user_id','=','users.id')
    ->select('users.id','profiles.profile_image','candidates.image','su__memebers.college','su__memebers.department','su__memebers.suid','su__memebers.fullname')
            ->where('users.account_status','=','pending')
            ->get();
return $candidates;

    }

    public function acceptRequest($id){
        $user =User::find($id);
        $user->account_status='active';
        $user->update();

        $candidate=new vote_count();
        $candidate->user_id=$id;
        $candidate->num_vots=0;
        $candidate->save();

        return response()->json('success',200);
    }
    public function rejectRequest($id){
        $user=User::find($id);
        $user->account_status='rejected';
        $user->update();
        return response()->json('success',200);
    }

    public function Destroy($id){
        $user=User::find($id);
        $user->delete();
        return response()->json('success',200);
    }
}
