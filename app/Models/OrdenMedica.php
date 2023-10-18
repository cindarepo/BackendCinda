<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenMedica extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "orden_medica";
    protected $primaryKey = "cod_orden_medica";
    protected $fillable = [
        "fecha_orden_medica",
        "vencimiento_orden_medica",
        "vigencia_orden_medica_dias",
        "estado_orden_medica",
        "cod_usuario_panda",
        "cantidad_sesiones"
    ];

}
