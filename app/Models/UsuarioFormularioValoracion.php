<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioFormularioValoracion extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "usuario_formulario_valoracion";
    protected $primaryKey = "cod_usuario_formulario_valoracion";
    protected $fillable = [
        "cod_tipo_formulario_valoracion",
        "detalle_encabezado_valoracion", "cod_usuario_panda", "cod_profesional",
        "estado_formulario_valoracion", "fecha_registro_formulario", "detalles_informante"
    ];
}
