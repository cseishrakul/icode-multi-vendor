<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getUsers(){
        $getUsers = User::get();
        // return $getUsers;
        return response()->json(['users'=>$getUsers],200);
    }
}
