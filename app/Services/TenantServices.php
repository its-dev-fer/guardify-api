<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Tenants;
use App\Helpers\SanitizeString;
use Str;
use Throwable;

class TenantServices {
    public static function register(Request $request){
        $response = [];
        try{
            $nombre_residencial = $request->input('nombre_residencial');
            $nombre_residencial_sanitizado = SanitizeString::run($nombre_residencial);
            if($nombre_residencial_sanitizado === "" || $nombre_residencial_sanitizado !== $nombre_residencial){
                return response()->json([
                    'success' => false,
                    'message' => 'el nombre de la residencial es invalido porque contiene codigo malicioso.'
                ]);
            }
            $ACTIVO = false;
            $tenant = Tenants::create([
                'id' => Str::uuid(),
                'nombre_residencial' => $nombre_residencial_sanitizado,
                'plan_id' => null,
                'stripe_customer_id' => null,
                'activo' => $ACTIVO,
                'fecha_inicio' => null,
                'fecha_fin' => null
            ]);
            return response()->json([
                'success' => true,
                'message' => 'nuevo tenant creado con exito.'
            ], 201);
        }catch(Throwable $error){
            $error_message = $error->getMessage();
            return response()->json([
                'success' => false,
                'message' => "Error: $error_message"
            ], 500);
        }
    }
}