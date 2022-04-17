<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionFormulariosValoracion extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "informacion_formularios_valoracion";
    protected $primaryKey = "cod_informacion_formularios_valoracion";
    protected $fillable = [
        "categoria_informacion_formularios_valoracion",
        "detalle_informacion_formularios_valoracion",
        "pertenece_anamnesis",
        "pertenece_iei_fono",
        "pertenece_iei_teo",
        "pertenece_iei_fisio",
        "cod_usuario_panda",
        "pertenece_rep_familia",
        "pertenece_f_psicosocial",

    ];
}



