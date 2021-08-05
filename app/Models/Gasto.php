<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    /*
     campos que pueden ser seteados al modelo, 
     con los que vienen del request cuando se registra o se actualiza un Gasto
     
     El modelo Gasto, representa a la tabla gastos, ello lo usa el ORM Eloquent para
     facilitar CRUD y otras operaciones sobre la Bases de datos
     */
    // se asume un gasto por mes
    protected $fillable = [
        'year',
        'month',
        'subtotal',
        'monto_iva',
        'total',
        'status',
        'approved_by_treasurer'
    ];

    const STATUS_INICIAL = 0; // o pendiente
    const STATUS_APROBADO = 1;
    const STATUS_DENEGADO = -1;

    // para consultar las lineas de un gasto
    public function lineas(){
        return $this->hasMany(GastoItem::class);
    }

}

