<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSangre extends Model
{
    // NO POSEE CONTROLADOR
    public $timestamps = false;
    use HasFactory;
    protected $table = "tipo_sangre";
    protected $primaryKey = "cod_tipo_sangre";
    protected $fillable = [
        "nom_tipo_sangre",
        "value_tipo_sangre",
        "status_tipo_sangre"
    ];

}
