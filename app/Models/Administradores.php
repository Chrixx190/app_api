<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administradores extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_ad',
        'password_ad',
        'nombre_ad',
        'apellido_ad',
        'cargo_ad',
        'rol_ad',
        'modulo_1',
        'modulo_2',
        'modulo_3',
    ];
}
