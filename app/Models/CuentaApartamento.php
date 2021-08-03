<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaApartamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartamento_id',
        'propietario_id',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];


}
