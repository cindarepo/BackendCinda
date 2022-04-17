<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    use HasFactory;

    public $timestamps = false;
    use HasFactory;

    protected $table = "entrevista_panda";
    protected $primaryKey = "cod_entrevista_panda";
    protected $fillable = [
        "cod_entrevista_panda",
        "entrevista_panda_fecha",
        "entrevista_panda_remite",
        "entrevista_panda_acompañante",
        "entrevista_panda_etiologia",
        "entrevista_panda_desarrollo_motor",
        "entrevista_panda_deteccion",
        "entrevista_panda_audifonos",
        "entrevista_panda_baha",
        "entrevista_panda_inplante_coclear",
        "entrevista_panda_orl",
        "entrevista_panda_comunicacion",
        "entrevista_panda_integracion_educativa",
        "entrevista_panda_recomendaciones",
        "entrevista_panda_entrevistador",
        "entrevista_panda_personal",
        "entrevista_panda_antecedentes"

    ];

    public function entrevista()
    {
        return $this->belongsTo(UsuarioPanda::class,
            'cod_usuario_panda',
            'entrevista_panda_entrevistador');
    }

    public function entrevista_panda_personal(){
        return $this->hasOne(PersonalCinda::class,
            'cod_personal_cinda',
            'entrevista_panda_personal');
    }



}
