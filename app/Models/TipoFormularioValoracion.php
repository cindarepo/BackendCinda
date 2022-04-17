<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoFormularioValoracion extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "tipo_formulario_valoracion";
    protected $primaryKey = "cod_tipo_fomulario_valoracion";
    protected $fillable = [
        "nom_formulario_valoracion",
        "value_formulario_valoracion"
    ];
}
