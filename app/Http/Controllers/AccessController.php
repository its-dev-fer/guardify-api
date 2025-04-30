<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccessController extends Controller{
    public function RegisterAdminAuth(Request $request){
        if(!$request->hasCookie('tenant_id')){
            return response()->json(['message' => 'unauthorized'], 401);
        }
        return response()->json(['message' => 'authorized'], 200);
    }
}