<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['nombre', 'limite_residentes', 'residentes_ilimitados', 'limite_vigilantes', 
    'vigilantes_ilimitados', 'precio_mensual'];

    protected $casts = [
        'residentes_ilimitados' => 'boolean',
        'vigilantes_ilimitados' => 'boolean'
    ];
}
