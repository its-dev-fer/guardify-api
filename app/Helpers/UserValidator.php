<?php

class UserValidator {

    private static array $permitidos = ['admin', 'vigilante', 'residente'];
    public static function validateRol(string $rol){
        return in_array($rol, self::$permitidos);
    }
}