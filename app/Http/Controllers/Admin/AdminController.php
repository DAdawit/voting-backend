<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AdminPost;
class AdminController extends Controller
{
//    public function Elections(){
//        $elections=DB::table('elections')->get();
//        return $elections;
//    }

    public function adminProfile(){
     $admin=DB::table('users')
         ->join('profiles','users.id','=','profiles.user_id')
         ->join('su__memebers','users.suid','=','su__memebers.suid')
         ->where('users.role','=','admin')
         ->select('users.id','profiles.profile_image','profiles.email','profiles.phone_number','su__memebers.fullname')
         ->get();
     return $admin;
 }

 public function approvedCandidates(){
     $candidates=DB::table('users')
         ->join('profiles','users.id','=','profiles.user_id')
         ->join('su__memebers','users.suid','=','su__memebers.suid')
         ->where('users.account_status','=','active')
         ->where('users.role','=','candidate')
         ->select('users.id','users.role','profiles.profile_image','profiles.email','profiles.phone_number','su__memebers.department','su__memebers.fullname')
         ->get();
     return $candidates;
 }
 public function createPost(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'description'=>'required'
        ]);

        $post=new AdminPost();
        $post->title=$request->title;
        $post->description=$request->description;
        $post->save();
        return response()->json('success',200);
 }

 public function adminPosts(){
        $adminPosts=DB::table('admin_posts')->get();
        return $adminPosts;
 }

 public function updatePost($id,Request $request){
     $post=AdminPost::find($id);
     $post->title=$request->title;
     $post->description=$request->description;
     $post->update();
     return response()->json('success',200);
 }

 public function deletePost($id){
     $post=AdminPost::find($id);
     $post->delete();
     return response()->json('success',200);
 }
}
