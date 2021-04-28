<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use File;
use App\Models\Candidate;
use App\Models\Campaign;
class candidateController extends Controller
{
    public function candidates(){
        $candidates=DB::table('users')
            ->join('profiles','users.id','=','profiles.user_id')
            ->join('su__memebers','users.suid','=','su__memebers.suid')
            ->select('users.id','profiles.profile_image','su__memebers.fullname')
            ->where('account_status','=','active')
            ->get();
        return $candidates;
    }


    public function store(Request $request){
        $this->validate($request, [
            'image'=>'required',
        ]);

            $imageName = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('../../vo_frontend/public/grade_reports/').$imageName);

            $candidate=new Candidate();
            $candidate->user_id=$request->user_id;
            $candidate->image='/grade_reports/'.$imageName;
            $candidate->save();
            return response()->json('success',200);
    }
    public function MYCampaigns($id){
        $campaign=DB::table('campaigns')
        ->where('user_id','=',$id)
        ->get();
        return $campaign;
    }

    public function createCampaign(Request $request){
        $campaign=new Campaign();
        $campaign->user_id=$request->user_id;
        $campaign->title=$request->title;
        $campaign->body=$request->body;
        $campaign->save();
        return response()->json('success',200);
    }

    public function UpdateCampaign(Request $request,$id){
        $campaign=Campaign::find($id);
        $campaign->title=$request->title;
        $campaign->body=$request->body;
        $campaign->update();
        return response()->json([
            'message'=>'success',
            'data'=>$campaign
        ],200);
    }

    public function DeleteCampaign($id){
        $campaign=Campaign::find($id);
        $campaign->delete();
    }

    public function Candidate_Campaign_posts($id){
        $campaigns=DB::table('campaigns')
            ->join('profiles','campaigns.user_id','=','profiles.user_id')
            ->select('campaigns.id','campaigns.title','campaigns.body','campaigns.created_at','profiles.profile_image')
            ->where('campaigns.user_id','=',$id)
            ->get();
        return $campaigns;
    }

        public function CandidateProfile($id){
            $profile=DB::table('users')
                ->join('profiles','users.id','=','profiles.user_id')
                ->join('su__memebers','users.suid','=','su__memebers.suid')
                ->where('users.id','=',$id)
                ->select('users.id','profiles.profile_image','profiles.email','profiles.phone_number','profiles.vision','su__memebers.fullname','su__memebers.department')
                ->get();
            return $profile;
        }

        public function fetchElection(){
        $election=DB::table('elections')
            ->get();
        return $election;
        }
}
