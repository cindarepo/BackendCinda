<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaInformacionFormularios extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "respuesta_informacion_formularios";
    protected $primaryKey = "cod_respuesta_informacion_formularios";
    protected $fillable = [
        "cod_informacion_formularios_valoracion",
        "cod_usuario_formulario_valoracion",
        "detalle_respuesta_formulario",
        "comentarios_respuesta_formulario",
    ];
}
