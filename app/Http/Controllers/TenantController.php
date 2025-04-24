<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TenantServices;

class TenantController extends Controller
{
    public function registerTenant(Request $request){
        return TenantServices::register($request);
    }
}
