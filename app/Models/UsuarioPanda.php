<?php

namespace App\Models;

use App\Models\EntidadesTipo\AmplificacionOido;
use App\Models\EntidadesTipo\Cie_audiologico;
use App\Models\EntidadesTipo\EntidadPlanDeBeneficios;
use App\Models\EntidadesTipo\TipoDePerdidaAuditiva;
use App\Models\EntidadesTipo\TipoGradoPerdida;
use App\Models\EntidadesTipo\TipoProceso;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioPanda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "usuario_panda";
    protected $primaryKey = "cod_usuario_panda";
    protected $fillable = [
        "cod_usuario_panda", "panda_fecha_ingreso_usuario", "panda_fecha_ultima_evaluacion",
        "panda_informacion_personal", "panda_tipo_proceso", "panda_tipo_perdida", "panda_grado_perdida",
        "panda_amplificacion_derecha", "panda_amplificacion_izquierdo", "panda_cod_status_usuario",
        "panda_edad_auditiva"
    ];


    public function referencias(){
        return $this->belongsToMany(InformacionReferido::class,
            ReferenciaUsuarioPanda::class,
            'cod_usuario_panda', 'cod_informacion_referido');
    }

    public function panda_informacion_personal(){
        return $this->hasOne(InformacionPersonalPanda::class,
            'cod_informacion_personal_panda',
            'panda_informacion_personal');
    }

    public function cirugias_usuario_panda(){
        return $this->hasMany(CirugiasUsuarioPanda::class,
            'cod_usuario_panda',
            'cod_usuario_panda');
    }



    public function panda_grado_perdida(){
        return $this->hasOne(TipoGradoPerdida::class,
            'cod_grado_perdida_auditiva',
            'panda_grado_perdida');
    }

    public function panda_tipo_proceso(){
        return $this->hasOne(TipoProceso::class, 'cod_tipo_proceso',
            'panda_tipo_proceso');
    }


    /**public function panda_cie_audiologico(){
        return $this->hasOne(Cie_audiologico::class, 'cod_cie_audiologico',
            'panda_cie_audiologico' );
    }*/
    public function panda_tipo_perdida(){
        return $this->hasOne(TipoDePerdidaAuditiva::class,  'cod_tipo_perdida_auditiva',
            'panda_tipo_perdida');
    }
    /**
    public function panda_amplificacion_derecha(){
        return $this->hasOne(AmplificacionOido::class, 'cod_tipo_amplificacion',
            'panda_amplificacion_derecha');
    }
    public function panda_amplificacion_izquierdo(){
        return $this->hasOne(AmplificacionOido::class, 'cod_tipo_amplificacion',
            'panda_amplificacion_izquierdo');
    }*/
    public function panda_plan_beneficios()
    {
        return $this->belongsToMany(EpsUsuarioPanda::class, EntidadPlanDeBeneficios::class,
            'cod_administrador_plan_beneficios', 'cod_usuario_panda');
    }

    public function panda_plan_beneficios_activo(){
        return $this->belongsToMany(EntidadPlanDeBeneficios::class,
            EpsUsuarioPanda::class,
            'cod_administrador_plan_beneficios', 'cod_administrador_plan_beneficios')
            ->where('estado_eps_usuario','=',1);
    }
    public function panda_cod_status_usuario(){
        return $this->hasOne(EstadoUsuarioPanda::class, 'cod_status_usuario_panda',
        'panda_cod_status_usuario');
    }

    public function orden_medica(){
        return $this->hasMany(OrdenMedica::class,
            'cod_usuario_panda',
            'cod_usuario_panda');
    }


    public function entrevista(){
        return $this->hasOne(Entrevista::class,
            'entrevista_panda_entrevistador',
            'cod_usuario_panda');
    }

    public function diagnosticos_cie(){
        return $this->hasMany(DiagnosticoCieUsuario::class,
            'cod_usuario_panda',
            'cod_usuario_panda');
    }

    public function diagnosticos_cif(){
        return $this->hasMany(DiagnosticoCifUsuario::class,
            'cod_usuario_panda',
            'cod_usuario_panda');
    }

    public function Cirugias(){
        return $this->hasMany(CirugiasUsuarioPanda::class,
            'cod_usuario_panda',
            'cod_usuario_panda');
    }

}
