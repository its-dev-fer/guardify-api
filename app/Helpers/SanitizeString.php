<?php
namespace App\Helpers;

class SanitizeString
{
    public static function run(string $dirty)
    {
        if (is_string($dirty)) {
            return strip_tags($dirty);
        }
        return "";
    }
}