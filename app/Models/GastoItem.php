<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'gasto_id',
        'proveedor_id',
        'cantidad',
        'precio_u',
        'descripcion',
        'iva'
    ];


    public function proveedor(){
        return $this->hasOne(Proveedor::class,'id','proveedor_id');
    }

}
