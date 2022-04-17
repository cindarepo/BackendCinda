<?php

namespace App\Models\PED;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescripcionInicioPed extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "descripcion_inicio";
    protected $primaryKey = "cod_descripcion_inicio";
    protected $fillable = [
        "detalle_descripcion_inicio",
        "estado_descripcion_inicio"
    ];
}
