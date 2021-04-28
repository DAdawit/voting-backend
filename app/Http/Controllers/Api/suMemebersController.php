<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\su_Memeber;

class suMemebersController extends Controller
{
    public function members(){
        $members=su_Memeber::all();
        return $members;
    }
    public function membersId(){
        $members=su_Memeber::all('suid');
        return $members;
    }
}
