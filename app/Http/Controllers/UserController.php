<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userProfile(){
        $user_details = auth()->user();
        return response()->json([
            'details'=>$user_details
        ]);
    }
}
