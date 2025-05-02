<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Tenants;
use App\Helpers\SanitizeString;
use Str;
use Throwable;

class TenantServices {
    public static function register(Request $request){
        $validated = $request->validate([
            "nombre_residencial" => "required|string"
        ]);
        try{
            $nombre_residencial = $validated['nombre_residencial'];
            $nombre_residencial_sanitizado = SanitizeString::run($nombre_residencial);
            if($nombre_residencial_sanitizado === "" || $nombre_residencial_sanitizado !== $nombre_residencial){
                return response()->json([
                    'message' => 'el nombre de la residencial es invalido porque contiene codigo malicioso.'
                ],422);
            }
            $ACTIVO = false;
            $nombre_residencial_formateado = Str::title($nombre_residencial_sanitizado);

            $storedSameTenant = Tenants::where('nombre_residencial', $nombre_residencial_formateado)->first();

            if($storedSameTenant){
                return response()->json([
                    'message' => 'este tenant ya ha sido registrado anteriormente.',
                    'tenant' => $storedSameTenant
                ]);
            }

            $tenant = Tenants::create([
                'id' => Str::uuid(),
                'stripe_subscription_id' => null,
                'nombre_residencial' => $nombre_residencial_formateado,
                'plan_id' => null,
                'stripe_customer_id' => null,
                'activo' => $ACTIVO,
                'fecha_inicio' => null,
                'fecha_fin' => null
            ]);
            return response()->json([
                'message' => 'nuevo tenant creado con exito.'
            ], 201)->cookie('tenant_id', $tenant->id, 30, null, null, true, true);
        }catch(Throwable $error){
            $error_message = $error->getMessage();
            return response()->json([
                'message' => "Error: $error_message"
            ], 500);
        }
    }
}