<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEstadoEntrega extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "tipo_estado_entrega";
    protected $primaryKey = "cod_tipo_estado_entrega";
    protected $fillable = [
        "nom_tipo_estado_entrega", "status_tipo_estado_entrega"
    ];
}
