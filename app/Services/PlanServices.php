<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Plans;

class PlanServices {
    public static function getPlan(Request $request){
        $nombre_plan = $request->route('nombre');
        $plan = Plans::where(['nombre' => $nombre_plan])->first();
        return response()->json([
            'message' => 'plan recuperado.',
            'plan' => $plan
        ], 200);
    }

    public static function getPlans(Request $request){
        $planes = Plans::all();
        return response()->json([
            'message' => 'todos los planes recuperados.',
            'planes' => $planes
        ], 200);
    }
}