<?php

namespace App\Models\EntidadesTipo;

use App\Models\UsuarioPanda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministradoraRiesgosLaborales extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "administradora_riesgo_laboral";
    protected $primaryKey = "cod_administradora_riesgo_laboral";
    protected $fillable = [
        "nom_administradora_riesgo_laboral",
        "value_administradora_riesgo_laboral"
    ];

}
