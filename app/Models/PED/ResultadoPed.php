<?php

namespace App\Models\PED;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadoPed extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "resultado_ped";
    protected $primaryKey = "cod_resultado_ped";
    protected $fillable = [
        "nom_resultado_ped", "detalle_resultado_ped", "relacion_cod_objetivo",
        "tipo_resultado_area"
    ];
}
