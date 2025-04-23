<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Helpers\SanitizeString;
use App\Models\Users;
use Throwable;
use UserValidator;

class UserServices {
    public static function register(Request $request){
        try {
            $request->validate([
                'email' => 'required|email'
            ]);
            $nombre = SanitizeString::run($request->input('nombre'));
            $email = SanitizeString::run($request->input('email'));
            $password = $request->input('password');
            $rol = $request->input('rol', null);

            if ($nombre === "" || $email === "" || empty($password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nombre, email y contraseña son requeridos y deben ser válidos.'
                ], 400);
            }

            $newUserAttr = [
                'id' => Str::uuid(),
                'tenant_id' => null,
                'nombre' => $nombre,
                'email' => $email,
                'password_hash' => Hash::make($password)
            ];

            if ($rol) {
                if(UserValidator::validateRol($rol)){
                    $newUserAttr['rol'] = $rol;
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'No tienes permisos para asignarte este rol.'
                    ], 403);
                }
            }

            Users::create($newUserAttr);

            return response()->json([
                'success' => true,
                'message' => 'Usuario registrado con éxito.'
            ], 201);
        } catch (Throwable $error) {
            $error_message = $error->getMessage();
            return response()->json([
                'success' => false,
                'message' => "Error: $error_message"
            ], 500);
        }
    }

    public static function registerInTenant(Request $request){
        
    }
}
