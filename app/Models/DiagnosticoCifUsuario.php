<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoCifUsuario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "diagnostico_cif_usuario";
    protected $primaryKey = "cod_diagnostico_cif_usuario";
    protected $fillable = [
        "cod_usuario_panda",
        "detalle_cif_usuario",
        "cod_tipo_diagnostico"
    ];

    public function cod_tipo_diagnostico(){
        return $this->hasOne(TipoDiagnostico::class,
            'cod_tipo_diagnostico',
            'cod_tipo_diagnostico');
    }


}
