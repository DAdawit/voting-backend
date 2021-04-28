<?php

namespace App\Http\Controllers\Election;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Election;
use Illuminate\Support\Facades\DB;
use App\Models\e_report;
use App\Models\vote_count;
use Illuminate\Support\Collection;
use App\Events\vote;
Use Carbon\Carbon;

class ElectionController extends Controller
{
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required',
            'registration_due_date'=>'required',
            'election_start_date'=>'required',
            'registration_due_time'=>'required',
        ]);

//        forstartvoting

        $date=$request->election_start_date.' '.$request->election_start_time;
        $electionends=Carbon::parse($date)->addMinutes(5);

        $election=new Election();
        $election->title=$request->title;
        $election->description=$request->description;
        $election->reg_due_date=$request->registration_due_date.' '.$request->registration_due_time;
        $election->election_start_date= $request->election_start_date.' '.$request->election_start_time;
        $election->election_due_date=$electionends;
        $election->save();
        return response()->json('success',200);
    }


    public function update (Request $request,$id){
        $election=Election::find($id);
        $date=$request->election_start_date.' '.$request->election_start_time;
        $electionends=Carbon::parse($date)->addMinutes(5);

        $election->title=$request->title;
        $election->description=$request->description;
        $election->reg_due_date=$request->registration_due_date.' '.$request->registration_due_time;
        $election->election_start_date= $request->election_start_date.' '.$request->election_start_time;
        $election->election_due_date=$electionends;
        $election->update();
        return response()->json('success',200);

    }


    public function vote_candidate(Request $request){

//        return $request;
            $voter=DB::table('e_reports')
                ->where('voter_uid','=',$request->uid)
                ->exists();
            if($voter){
                return response()->json('you already voted !' ,400);
            }else{
                $vote=new e_report();
                $vote->user_id=$request->user_id;
                $vote->voter_uid=$request->uid;
                $vote->save();

                $candidate=vote_count::find($request->user_id);
                $candidate->num_vots=$candidate->num_vots+1;
                $candidate->update();
                broadcast(new vote($candidate))->toOthers();

                return response()->json('success','200');
            }
    }

    public function voting(){
        $candidates=DB::table('users')
            ->join('vote_counts','users.id','=','vote_counts.user_id')
            ->join('su__memebers','users.suid','=','su__memebers.suid')
            ->join('profiles','users.id','=','profiles.user_id')
            ->select('vote_counts.id','vote_counts.num_vots','profiles.profile_image','su__memebers.fullname','su__memebers.department')
            ->orderBy('vote_counts.num_vots','desc')
            ->get();
        return $candidates;
    }
    public function electionInfo(){
        $election = DB::table('elections')
            ->select('id','title','election_start_date','election_due_date','reg_due_date')
            ->get();
        return $election;
    }

    public function FetchElection(){
        $election = DB::table('elections')
            ->get();
        return $election;
    }
    public function DeleteElection($id){
        $election =Election::find($id);
        $election->delete();
        return response()->json('success',200);
    }

public function Elections(){
    $election = DB::table('elections')
        ->get();
    return $election;
}

}
