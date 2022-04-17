<?php

namespace App\Models;

use App\Models\EntidadesTipo\AdministradoraRiesgosLaborales;
use App\Models\EntidadesTipo\CajaCompensacion;
use App\Models\EntidadesTipo\EntidadPlanDeBeneficios;
use App\Models\EntidadesTipo\FondoDePensiones;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionComplementariaEmpleado extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "informacion_complementaria_empleado";
    protected $primaryKey = "cod_informacion_complementaria_empleado";
    protected $fillable = [
        "complementaria_caja_compensacion",
        "complementaria_administradora_riesgo_laboral",
        "complementaria_fondo_pension",
        "complementaria_administrador_plan_beneficios",
        "complementaria_clinica_atencion_emergencia",
        "complementaria_condicion_especial_salud",
        "complementaria_medicamentos",
        "nombre_contacto_emergencia",
        "parentesco_contacto_emergencia",
        "telefono_contacto_emegencia",
    ];


    public function complementaria_administrador_plan_beneficios(){
        return $this->hasOne(EntidadPlanDeBeneficios::class,
            'cod_administrador_plan_beneficios',
            'complementaria_administrador_plan_beneficios');
    }

    public function complementaria_caja_compensacion(){
        return $this->hasOne(CajaCompensacion::class,
            'cod_caja_compensacion',
            'complementaria_caja_compensacion');
    }


    public function complementaria_fondo_pension(){
        return $this->hasOne(FondoDePensiones::class,
            'cod_fondo_pension',
            'complementaria_fondo_pension');
    }

    public function complementaria_administradora_riesgo_laboral(){
        return $this->hasOne(AdministradoraRiesgosLaborales::class,
            'cod_administradora_riesgo_laboral',
            'complementaria_administradora_riesgo_laboral');
    }
}
