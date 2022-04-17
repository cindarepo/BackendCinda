<?php

namespace App\Models;

use App\Models\EntidadesTipo\DocumentoDeIdentificacion;
use App\Models\EntidadesTipo\Parentesco;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionReferido extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "informacion_referido";
    protected $primaryKey = "cod_informacion_referido";
    protected $fillable = [
        "referido_primer_nombre",
        "referido_segundo_nombre",
        "referido_primer_apellido",
        "referido_segundo_apellido",
        "referido_telefono_principal",
        "referido_telefono_otro",
        "referido_correo_electronico",
        "referido_tipo_documento",
        "referido_identificacion",
        "referido_fecha_nacimiento",
        "referido_nivel_educativo",
        "referido_ocupacion" ,
        "referido_lugar_trabajo" ,
        "referido_horario_trabajo",
        "referido_actividad_economica" ,
        "referido_informacion_vivienda"
    ];

    public function usuarios(){
        return $this->belongsToMany(UsuarioPanda::class);
    }

    public function relacionParentesco(){
        return  $this->hasMany(ReferenciaUsuarioPanda::class, 'cod_informacion_referido',
        'cod_informacion_referido')->select(['cod_informacion_referido','cod_tipo_parentesco']);
    }

    public function referido_informacion_vivienda(){
        return $this->hasOne(InformacionVivienda::class, 'cod_informacion_vivienda',
            'referido_informacion_vivienda');
    }

    public function referido_tipo_documento(){
        return $this->hasOne(DocumentoDeIdentificacion::class, 'cod_tipo_documento_identificacion',
            'referido_tipo_documento');
    }







}
