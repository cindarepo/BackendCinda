<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoTablasTipo extends Model
{
    // NO POSEE CONTROLADOR
    public $timestamps = false;
    use HasFactory;
    protected $table = "status_tablas_tipo";
    protected $primaryKey = "cod_status_tablas_tipo";
    protected $fillable = [
        "nom_estatus"
    ];

}
