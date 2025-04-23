<?php
namespace App\Helpers;

class SanitizeString
{
    public static function run(?string $dirty): string{
        if (!is_string($dirty)) {
            return "";
        }
        $clean = trim($dirty);
        $clean = strip_tags($clean);
        $clean = htmlspecialchars($clean, ENT_QUOTES);
        $clean = preg_replace('/\s+/', ' ', $clean);
        return $clean;
    }
}
