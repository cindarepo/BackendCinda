<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoRegistro extends Model
{
    // NO POSEE CONTROLADOR
    public $timestamps = false;
    use HasFactory;
    protected $table = "estado_registro";
    protected $primaryKey = "cod_estado_registro";
    protected $fillable = [
        "nombre_estado_registro"
    ];
}
