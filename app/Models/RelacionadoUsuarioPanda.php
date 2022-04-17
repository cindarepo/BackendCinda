<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelacionadoUsuarioPanda extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "relacionado_usuario_panda";
    protected $primaryKey = "cod_relacionado_usuario_panda";
    protected $fillable = [
        "nom_relacionado_usuario_panda",
        "anio_nacimiento_relaciondo", "cod_tipo_parentesco",
        "ocupacion_relacionado_usuario_panda", "vive_usuario_panda"

    ];
}
