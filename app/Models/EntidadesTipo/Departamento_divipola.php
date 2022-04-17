<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento_divipola extends Model
{
    // NO POSEE CONTROLADOR
    public $timestamps = false;
    use HasFactory;
    protected $table = "departamento_divipola";
    protected $primaryKey = "cod_departamento_divipola";
    protected $fillable = [
        "nom_departamento_divipola", "value_departamento_divipola",
        "codigo_divipola", "status_departamento_divipola"
    ];
}
