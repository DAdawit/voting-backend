<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignOutController;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\BidController;

use App\Http\Controllers\Api\suMemebersController;
use App\Http\Controllers\Candidate\candidateController;
use App\Http\Controllers\Admin\ManageCandidateController;
use App\Http\Controllers\Admin\SU_MemebersController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Election\ElectionController;
use App\Http\Controllers\Auth\Admin;
use App\Http\Controllers\Auth\Student_Controller;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'Admin','namespace'=>'Admin'],function(){
    Route::get('fetchCandidates',[ManageCandidateController::class,'fetchCandidates']);
    Route::get('acceptRequest/{id}',[ManageCandidateController::class,'acceptRequest']);
    Route::get('rejectRequest/{id}',[ManageCandidateController::class,'rejectRequest']);
    Route::post('storeSuMemebers',[SU_MemebersController::class,'store']);

    Route::get('husuMemebers',[SU_MemebersController::class,'memebers']);
    Route::post('updateMemeber/{id}',[SU_MemebersController::class,'update']);
    Route::post('deleteMemeber/{id}',[SU_MemebersController::class,'destroy']);
    Route::get('adminProfile',[AdminController::class,'adminProfile']);
    Route::get('approvedCandidates',[AdminController::class,'approvedCandidates']);
    Route::post('createPost',[AdminController::class,'createPost']);
    Route::post('deletePost/{id}',[AdminController::class,'deletePost']);

    Route::get('adminPosts',[AdminController::class,'adminPosts']);
    Route::post('EditPost/{id}',[AdminController::class,'updatePost']);
    Route::post('DeleteCandidate/{id}',[ManageCandidateController::class,'Destroy']);

    Route::post('CreateElection',[ElectionController::class,'store']);
    Route::get('fetchelections',[ElectionController::class,'FetchElection']);
    Route::post('updateElection/{id}',[ElectionController::class,'update']);
    Route::post('deleteElection/{id}',[ElectionController::class,'DeleteElection']);
});

Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){
   Route::post('signin',[SignInController::class,'SignIn']);
   Route::post('adminLogin',[SignInController::class,'AdminLogin']);
   Route::post('studentLogin',[SignInController::class,'StudentLogin']);
   Route::post('signout',[SignOutController::class,'SignOUt']);
   Route::get('me',[MeController::class,'Me']);
   Route::get('admin',[Admin::class,'Admin']);
   Route::get('student',[Student_Controller::class,'Student']);
   Route::post('register',[RegisterController::class,'Register']);
   Route::post('changeUserPassword',[RegisterController::class,'changePassword']);
   Route::post('studentLogin',[SignInController::class,'StudentLogin']);
});


Route::group(['prefix'=>'user','namespace'=>'Api'],function(){
    Route::post('register',[RegisterController::class,'Register']);
    Route::post('storeprofile',[ProfileController::class,'store']);
});

Route::group(['prefix'=>'st_un','namespace'=>'Api'],function(){
    Route::get('su_memebers',[suMemebersController::class,'members']);
    Route::get('membersId',[suMemebersController::class,'membersId']);
});

Route::group(['prefix'=>'candidates','namespace'=>'Candidates'],function(){
    Route::post('storeGradeReport',[candidateController::class,'store']);
    Route::get('myCampaign/{id}',[candidateController::class,'MYCampaigns']);
    Route::post('postCampaign',[candidateController::class,'createCampaign']);
    Route::post('updateCampaign/{id}',[candidateController::class,'UpdateCampaign']);
    Route::post('deleteCampaign/{id}',[candidateController::class,'DeleteCampaign']);
    Route::get('ActiveCandidates',[candidateController::class,'candidates']);
    Route::get('campaigns/{id}',[candidateController::class,'Candidate_Campaign_posts']);
    Route::get('candidateProfile/{id}',[candidateController::class,'CandidateProfile']);

    Route::post('storeContact',[ProfileController::class,'store']);
    Route::get('myProfile/{id}',[ProfileController::class,'profile']);
    Route::get('checkProfileExist/{id}',[ProfileController::class,'checkProfileExist']);
    Route::post('updateProfile/{id}',[ProfileController::class,'update']);
    Route::get('election',[candidateController::class,'fetchElection']);
});

Route::group(['prefix'=>'election','namespace'=>'Election'],function(){
//    Route::get('elections',[ElectionController::class,'Elections']);
    Route::post('vote',[ElectionController::class,'vote_candidate']);
    Route::get('candidates',[ElectionController::class,'voting']);
    Route::get('electioninfo',[ElectionController::class,'electionInfo']);
});

