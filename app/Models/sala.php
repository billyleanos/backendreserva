<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    protected $table = 'salas';  // Nombre de la tabla
    protected $primaryKey = 'id_sala';  // Clave primaria
    protected $fillable = ['nombre_sala', 'capacidad', 'descripcion', 'estado'];  // Campos asignables

    public $timestamps = false;  // Deshabilita las marcas de tiempo automáticas si no las usas
}

