<?php

namespace App\Models;

use App\Models\EntidadesTipo\EstandarCie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoCieUsuario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "diagnostico_cie_usuario";
    protected $primaryKey = "cod_diagnostico_cie_usuario";
    protected $fillable = [
        "cod_usuario_panda",
        "cod_estandar_cie",
        "detalle_diagnostico_cie",
        "cod_tipo_diagnostico"
    ];

    public function cod_tipo_diagnostico(){
        return $this->hasOne(TipoDiagnostico::class,
            'cod_tipo_diagnostico',
            'cod_tipo_diagnostico');
    }

    public function cod_estandar_cie(){
        return $this->hasOne(Estandarcie::class,
            'cod_estandar_cie',
            'cod_estandar_cie');
    }
}
