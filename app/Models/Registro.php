<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    public $table = 'registro';
    use HasFactory;
    protected $fillable = [
        'id_est',
        'asistencia_ad',
        'fecha_ad',
    ];
}
