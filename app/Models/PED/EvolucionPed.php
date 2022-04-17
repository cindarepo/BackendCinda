<?php

namespace App\Models\PED;

use App\Models\EntidadesTipo\Mes;
use App\Models\UsuarioPanda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvolucionPed extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "evolucion_mensual_ped";
    protected $primaryKey = "cod_evolucion_mensual_ped";
    protected $fillable = [
        "cod_usuario_panda",
        "anio_evolucion",
        "cod_mes",
        "numero_sesiones",
        "cod_estado_evolucion"
    ];

    public function cod_usuario_panda(){
        return $this->hasOne(UsuarioPanda::class,
            'cod_usuario_panda',
            'cod_usuario_panda');
    }

    public function cod_mes(){
        return $this->hasOne(Mes::class,
            'cod_mes',
            'cod_mes');
    }

    public function numero_sesiones(){
        return $this->hasOne(CantidadSesionesUsuario::class,
            'cod_cantidad_sesiones_usuario',
            'numero_sesiones');
    }
    public function evolucion_registro(){
        return $this->belongsTo(RegistroPed::class,
            'cod_evolucion_ped',
            'cod_evolucion_mensual_ped');
    }
}
