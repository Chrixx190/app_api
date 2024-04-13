<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleRegistros extends Model
{
    public $table = 'registro_persona';
    use HasFactory;
    protected $fillable = [
        'id',
        'id_aula',
        'fecha_registro',
    ];
}