<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenants extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['id','nombre_residencial', 'plan_id', 'stripe_customer_id', 'activo', 'fecha_inicio', 'fecha_fin', 'stripe_subscription_id'];

    protected $table = 'tenants';

    protected $casts = [
        'activo' => 'boolean',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date'
    ];

}
