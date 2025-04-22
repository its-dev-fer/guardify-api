<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['tenant_id', 'residente_id', 'nombre_visitante', 'fecha_hora'];

    protected $casts = [
        'fecha_hora' => 'datetime'
    ];
}
