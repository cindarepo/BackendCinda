<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CirugiasUsuarioPanda extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "cirugias_usuario_panda";
    protected $primaryKey = "cirugias_usuario_panda";
    protected $fillable = [
        "fecha_cirugia_usuario_panda",
        "nombre_cirugia",
        "detalles_cirugia",
        "cod_usuario_panda"
    ];

}
