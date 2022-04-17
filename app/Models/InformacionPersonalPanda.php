<?php

namespace App\Models;

use App\Models\EntidadesTipo\DocumentoDeIdentificacion;
use App\Models\EntidadesTipo\PaisDeNacionalidad;
use App\Models\EntidadesTipo\SexoBiologico;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionPersonalPanda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "informacion_personal_panda";
    protected $primaryKey = "cod_informacion_personal_panda";
    protected $fillable = [
        "panda_primer_nombre",
        "panda_segundo_nombre",
        "panda_primer_apellido",
        "panda_segundo_apellido",
        "panda_sexo_biologico",
        "panda_tipo_documento",
        "panda_documento_id",
        "panda_pais_nacimiento",
        "panda_fecha_nacimiento",
        "panda_informacion_vivienda",
    ];

    // HAS ONE
    public function panda_sexo_biologico(){
        return $this->hasOne(SexoBiologico::class, 'cod_sexo_biologico',
            'panda_sexo_biologico');
    }


    public function panda_tipo_documento(){
        return $this->hasOne(DocumentoDeIdentificacion::class, 'cod_tipo_documento_identificacion',
            'panda_tipo_documento');
    }


    public function panda_pais_nacimiento(){
        return $this->hasOne(PaisDeNacionalidad::class, 'cod_pais',
            'panda_pais_nacimiento');
    }
    public function panda_informacion_vivienda(){
        return $this->hasOne(InformacionVivienda::class, 'cod_informacion_vivienda',
            'panda_informacion_vivienda');
    }

    // PERTENECE A
    public function panda_informacion_personal(){
        return $this->hasMany(UsuarioPanda::class, 'cod_informacion_personal_panda',
            'panda_informacion_personal');
    }
}
