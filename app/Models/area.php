<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';  // Nombre de la tabla
    protected $primaryKey = 'id_area';  // Clave primaria
    protected $fillable = ['nombre_area'];  // Campos asignables

    public $timestamps = false;  // Deshabilita las marcas de tiempo automáticas si no las usas
}

