<?php

namespace App\Models;

use App\Models\EntidadesTipo\DocumentoDeIdentificacion;
use App\Models\EntidadesTipo\PaisDeNacionalidad;
use App\Models\EntidadesTipo\SexoBiologico;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionPersonalEmpleado extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "informacion_personal_empleado";
    protected $primaryKey = "cod_informacion_personal_empleado";
    protected $fillable = [
             "empleado_primer_nombre","empleado_segundo_nombre", "empleado_primer_apellido", "empleado_segundo_apellido",
            "empleado_sexo_biologico", "empleado_tipo_documento", "empleado_documento_id",
            "empleado_fecha_nacimiento", "emleado_direccion", "empleado_localidad",
            "empleado_telefono", "empleado_celular", "empleado_correo_electronico",
            "cod_tipo_sangre"
    ];

    // HAS ONE
    public function empleado_sexo_biologico(){
        return $this->hasOne(SexoBiologico::class, 'cod_sexo_biologico',
            'empleado_sexo_biologico');
    }


    public function empleado_tipo_documento(){
        return $this->hasOne(DocumentoDeIdentificacion::class, 'cod_tipo_documento_identificacion',
            'empleado_tipo_documento');
    }


}
