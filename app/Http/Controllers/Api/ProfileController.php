<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use File;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
//        return $request;
        $this->validate($request, [
            'phone_number' => 'required',
            'email' => 'required|email'
        ]);

        $imageName = time() . '.' . explode('/', explode(':', substr($request->profile_image, 0, strpos($request->profile_image, ';')))[1])[1];
        \Image::make($request->profile_image)->save(public_path('../../vo_frontend/public/profile_images/') . $imageName);

        $profile = new Profile();
        $profile->user_id = $request->user_id;
        $profile->phone_number = $request->phone_number;
        $profile->email = $request->email;
        $profile->vision=$request->vision;
        $profile->profile_image = '/profile_images/' . $imageName;
        $profile->save();
        return response()->json('success', 200);
    }

    public function profile($id){
        $contactInfo=DB::table('profiles')
            ->where('user_id','=',$id)
            ->get();
        return $contactInfo;
    }

    public function checkProfileExist($id){
        $profile=DB::table('profiles')
            ->where('user_id','=',$id)
            ->exists();
        if($profile){
            return response()->json('success', 200);
        }else{
            return response()->json(['error' => 'contact info not found'], 401);
        }
    }

    public function update($id ,Request $request){

        $profile=Profile::find($id);
//        return $profile;

//        if($request->profile_image) {
//            return 'there is image';
//        }else
//            return 'no image';

            if($request->profile_image){
            $imageName = time() . '.' . explode('/', explode(':', substr($request->profile_image, 0, strpos($request->profile_image, ';')))[1])[1];
            \Image::make($request->profile_image)->save(public_path('../../vo_frontend/public/profile_images/') . $imageName);
            unlink('../../vo_frontend/public'.$profile->profile_image);
//                $image1='../../frontend/public'.$oldimage->image;
            $profile->phone_number=$request->phone_number;
            $profile->email=$request->email;
            $profile->vision=$request->vision;
            $profile->profile_image = '/profile_images/' . $imageName;
            $profile->update();
            return response()->json('success',200);
        }else{
            $profile->phone_number=$request->phone_number;
            $profile->email=$request->email;
            $profile->vision=$request->vision;
            $profile->update();
            return response()->json('success',200);
        }

    }
}
