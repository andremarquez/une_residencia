<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'gasto_id',
        'cuenta_apartamento_id',
        'alicuota',
        'monto'
    ];

    // para obtener gasto
    public function gasto()
    {
        return $this->hasOne(Gasto::class,'id','gasto_id');
    }

    // para obtener cuenta apartamento
    public function cuenta()
    {
        return $this->hasOne(CuentaApartamento::class,'id','cuenta_apartamento_id');
    }
}
