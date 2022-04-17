<?php

namespace App\Models\PED;

use App\Models\EntidadesTipo\Area;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadPed extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "actividad_ped";
    protected $primaryKey = "cod_actividad_ped";
    protected $fillable = [
         "nom_referencia_ped", "detalle_actividad_ped", "relacion_cod_objetivo",
        "relacion_area_general"
    ];


    public function relacion_cod_objetivo(){
        return $this->hasMany(ObjetivosGeneralesPed::class,
            'relacion_cod_objetivo',
            'cod_objetivo_general');
    }

    public function relacion_area_general(){
        return $this->hasMany(Area::class,
            'relacion_area_general',
            'cod_area');
    }
}
