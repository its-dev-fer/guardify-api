<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserServices;

class UserController extends Controller
{
    public function register(Request $request){
        return UserServices::register($request);
    }
}
