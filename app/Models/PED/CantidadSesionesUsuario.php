<?php

namespace App\Models\PED;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CantidadSesionesUsuario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "cantidad_sesiones_usuario";
    protected $primaryKey = "cod_cantidad_sesiones_usuario";
    protected $fillable = [
        "cantidad_fono",
        "cantidad_fisioterapia",
        "cantidad_psicologia",
        "cantidad_teo",
        "cantidad_musico",
        "cantidad_habla",
        "cod_usuario_panda"
    ];
}







