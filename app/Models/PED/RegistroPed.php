<?php

namespace App\Models\PED;

use App\Models\EntidadesTipo\EstadoRegistro;
use App\Models\UsuarioPanda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroPed extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "registro_ped";
    protected $primaryKey = "cod_registro_ped";
    protected $fillable = [
        "descripcion_inicio", "descripcion_final", "cod_horario_sesion",
        "fecha_registro_ped", "detalle_objetivo_ped", "detalle_actividad_registro",
        "detalle_resultado_registro", "detalle_recomendacion_registro", "cod_profesional", "cod_usuario_panda",
        "cod_evolucion_ped", "cod_area_general", "estado_registro_ped"
    ];

    public function cod_evolucion_ped(){
        return $this->hasMany(EvolucionPed::class,
            'cod_evolucion_mensual_ped',
            'cod_evolucion_ped');
    }

    public function cod_usuario_panda(){
        return $this->hasOne(UsuarioPanda::class,
            'cod_usuario_panda',
            'cod_usuario_panda')->select('cod_usuario_panda');
    }
    public function estado_registro_ped(){
        return $this->hasOne(EstadoRegistro::class,
            'cod_estado_registro',
            'estado_registro_ped');
    }

    public function cod_horario_sesion(){
        return $this->hasMany(HorarioSesionPed::class,
            'cod_horario_sesion',
            'cod_horario_sesion');
    }

/**
    public function descripcion_inicio(){
        return $this->hasMany(DescripcionInicioPed::class,
            'cod_descripcion_inicio',
            'descripcion_inicio');
    }

    public function descripcion_final(){
        return $this->hasMany(DescripcionFinalPed::class,
            'cod_descripcion_final',
            'descripcion_final');
    }



    public function detalle_objetivo_ped(){
        return $this->hasMany(ObjetivoPed::class,
            'cod_objetivo_ped',
            'detalle_objetivo_ped');
    }

    public function detalle_actividad_registro(){
        return $this->hasMany(ObjetivoPed::class,
            'cod_objetivo_ped',
            'detalle_objetivo_ped');
    }

*/


}

