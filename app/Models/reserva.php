<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';  // Nombre de la tabla
    protected $primaryKey = 'id_reserva';  // Clave primaria
    protected $fillable = [
        'id_usuario', 
        'id_sala', 
        'id_area', 
        'fecha_reserva', 
        'hora_inicio', 
        'hora_fin', 
        'evento', 
        'estado'
    ];  // Campos asignables

    public $timestamps = false;  // Deshabilita las marcas de tiempo automáticas si no las usas

    // Define las relaciones
    public function sala()
    {
        return $this->belongsTo(Sala::class, 'id_sala');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }
}



