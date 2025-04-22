<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Tenants;
use Str;

class TenantController extends Controller
{
    public function registerTenant(Request $request){
        $nombre_residencial = $request->input('nombre_residencial');
        $ACTIVO = false;
        $tenant = Tenants::create([
            'id' => Str::uuid(),
            'nombre_residencial' => $nombre_residencial,
            'plan_id' => null,
            'stripe_customer_id' => null,
            'activo' => $ACTIVO
        ]);
        $tenant->save();
        return response()->json([
            "activo" => $ACTIVO,
            "nombre residencial" => $nombre_residencial,
            "message" => "la ruta ha funcionado",
            "data" => $tenant->toArray()
        ], 200, ["mi header" => "holaaaaaa"]);
    }
}
