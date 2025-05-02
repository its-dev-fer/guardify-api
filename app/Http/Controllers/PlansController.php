<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanServices;

class PlansController extends Controller
{
    public function getPlan(Request $request){
        return PlanServices::getPlan($request);
    }

    public function getPlans(Request $request){
        return PlanServices::getPlans($request);
    }
}
