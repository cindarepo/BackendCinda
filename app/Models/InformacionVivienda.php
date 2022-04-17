<?php

namespace App\Models;

use App\Models\EntidadesTipo\MunicipioDeResidencia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionVivienda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "informacion_vivienda";
    protected $primaryKey = "cod_informacion_vivienda";
    protected $fillable = [
        'cod_municipio',
        'localidad_vivienda',
        'barrio_vivienda',
        'direccion_vivienda',
        'estrato_vivienda'
    ];

    public function vivienda(){
        return $this->hasOne(InformacionPersonalPanda::class, 'panda_informacion_vivienda',
            'cod_informacion_vivienda');
    }

    public function cod_municipio(){
        return $this->hasOne(MunicipioDeResidencia::class, 'cod_municipio_divipola',
            'cod_municipio');
    }



    public function viviendaReferido(){
        return $this->hasOne(InformacionReferido::class, 'cod_informacion_vivienda',
            'panda_informacion_vivienda');
    }


}
