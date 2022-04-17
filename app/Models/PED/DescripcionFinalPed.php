<?php

namespace App\Models\PED;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescripcionFinalPed extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "descripcion_final";
    protected $primaryKey = "cod_descripcion_final";
    protected $fillable = [
        "detalle_descripcion_final",
        "estado_descripcion_final"
    ];
}
