<?php

namespace App\Models\EntidadesTipo;

use App\Models\UsuarioPanda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmplificacionOido extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "tipo_amplificacion";
    protected $primaryKey = "cod_tipo_amplificacion";
    protected $fillable = [
        'nom_tipo_amplificacion',
        'value_tipo_amplificacion',
        'status_tipo_amplificacion'
    ];

    public function amplificacionIzquierdo_usuario(){
        return $this->hasMany(UsuarioPanda::class, 'panda_amplificacion_izquierdo',
            'cod_tipo_amplificacion',
            );
    }

    public function amplificacionDerecho_usuario(){
        return $this->hasMany(UsuarioPanda::class, 'panda_amplificacion_derecha',
            'cod_tipo_amplificacion',
        );
    }
}

