<?php

namespace App\Models;

use App\Models\EntidadesTipo\EntidadPlanDeBeneficios;
use App\Models\EntidadesTipo\EstadoPersonal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalCinda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "personal_cinda";
    protected $primaryKey = "cod_personal_cinda";
    protected $fillable = [
        "fecha_ingreso_personal",
        "fecha_retiro_personal",
        "cod_informacion_personal_empleado",
        "cod_informacion_complementaria_empleado",
        "informacion_contrato",
        "cod_estado_personal",
        "cod_usuario_aplicativo"

    ];


    public function cod_informacion_personal_empleado(){
        return $this->hasOne(InformacionPersonalEmpleado::class,
            'cod_informacion_personal_empleado',
            'cod_informacion_personal_empleado');
    }

    public function cod_informacion_complementaria_empleado(){
        return $this->hasOne(InformacionComplementariaEmpleado::class,
            'cod_informacion_complementaria_empleado',
            'cod_informacion_complementaria_empleado');
    }

    public function profesional_relacion(){
        return $this->belongsTo(ProfesionalCinda::class,
        'cod_personal_cinda',
        'cod_personal_cinda');
    }

    public function cod_usuario_aplicativo(){
        return $this->hasOne(User::class,
            'cod_user',
            'cod_usuario_aplicativo');
    }

    public function cod_estado_personal(){
        return $this->hasOne(EstadoPersonal::class,
            'cod_estado_personal',
            'cod_estado_personal');
    }
}
