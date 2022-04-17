<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoUsuario extends Model
{
    // NO POSEE CONTROLADOR
    public $timestamps = false;
    use HasFactory;
    protected $table = "estado_usuario";
    protected $primaryKey = "cod_estado_usuario";
    protected $fillable = [
        "nom_estado_usuario",
        "value_estado_usuario",
        "status_estado_usuario"

    ];

}
