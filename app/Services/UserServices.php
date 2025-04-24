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
    public static function RegisterResidentialAdmin(Request $request){
        try {
            $validated = $request->validate([
                'nombre' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'tenant_id' => 'required|uuid'
            ]);
            $nombre = SanitizeString::run($validated['nombre']);
            $email = SanitizeString::run($validated['email']);
            $password = $validated['password'];
            $tenant_id = $validated['tenant_id'];
            $ROL = 'admin';

            $newUserAttr = [
                'id' => Str::uuid(),
                'tenant_id' => $tenant_id,
                'nombre' => $nombre,
                'email' => $email,
                'password_hash' => Hash::make($password),
                'rol' => $ROL
            ];

            Users::create($newUserAttr);

            return response()->json([
                'message' => 'Usuario registrado con éxito.'
            ], 201);
        } catch (Throwable $error) {
            $error_message = $error->getMessage();
            return response()->json([
                'message' => "Error: $error_message"
            ], 500);
        }
    }
}
