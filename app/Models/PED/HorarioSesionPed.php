<?php

namespace App\Models\PED;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioSesionPed extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "horario_sesion";
    protected $primaryKey = "cod_horario_sesion";
    protected $fillable = [
        "detalle_horario_sesion"
    ];
}
