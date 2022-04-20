<?php

namespace App\Models\PED;

use App\Models\ProfesionalCinda;
use App\Models\UsuarioPanda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionProfesionales extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "asignacion_profesionales";
    protected $primaryKey = "cod_asignacion_profesionales";
    protected $fillable = [
        "cod_nino_panda",
        "cod_psicologa",
        "cod_fonoaudiologa",
        "cod_musica",
        "cod_teo",
        "cod_habla",
        "cod_fisioterapia",
        "cod_logogenia",
        "cod_apoyo"
    ];

    public function cod_nino_panda(){
        return $this->hasMany(UsuarioPanda::class,
            'cod_usuario_panda',
            'cod_nino_panda');
    }

    //TODO PREGUNTAR QUE CODIGO SE TOMA
    public function  cod_fonoaudiologa(){
        return $this->hasMany(ProfesionalCinda::class,
            'cod_profesional_cinda',
            'cod_fonoaudiologa');
    }

    public function  cod_psicologa(){
        return $this->hasMany(ProfesionalCinda::class,
            'cod_profesional_cinda',
            'cod_psicologa');
    }


    public function  cod_musica(){
        return $this->hasMany(ProfesionalCinda::class,
            'cod_profesional_cinda',
            'cod_musica');
    }

    public function  cod_teo(){
        return $this->hasMany(ProfesionalCinda::class,
            'cod_profesional_cinda',
            'cod_teo');
    }
    public function  cod_habla(){
        return $this->hasMany(ProfesionalCinda::class,
            'cod_profesional_cinda',
            'cod_habla');
    }

    public function  cod_fisioterapia(){
        return $this->hasMany(ProfesionalCinda::class,
            'cod_profesional_cinda',
            'cod_fisioterapia');
    }

}
