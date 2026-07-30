<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria',
        'nombre',
        'descripcion',
        'precio',
        'imagen_principal',
        'imagen1',
        'imagen2',
        'imagen3',
        'imagen4',

    ];
}
