<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // constante de los roles de usuarios
    const ROL_ADMIN = 1;
    const ROL_TESORERO = 2;
    const ROL_PROPIETARIO = 3;
}
