<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesEncabezadoValoracion extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "detalle_encabezado_valoracion";
    protected $primaryKey = "cod_detalle_encabezado_valoracion";
    protected $fillable = [
        "encabezado_nombre_formato",
        "encabezado_codigo_formato",
        "encabezado_fecha_formato",
        "encabezado_version_formato"
    ];

}
