<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    use HasFactory;

    /*
     campos que pueden ser seteados al modelo, 
     con los que vienen del request cuando se registra o se actualiza un Comprobante
     
     El MODELO Comprobante, representa a la TABLA comprobantes, ello lo usa el ORM Eloquent para
     facilitar CRUD y otras operaciones sobre la Bases de datos
     */
    // se asume un gasto por mes
    protected $fillable = [
        'factura_id',
        'dato_bancario_id',
        'payment_date',
        'cuenta_apartament_id',
        'file_url',
        'approved_by_treasurer'
    ];
}
