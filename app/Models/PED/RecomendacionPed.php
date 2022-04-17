<?php

namespace App\Models\PED;

use App\Models\EntidadesTipo\Area;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecomendacionPed extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "recomendacion_ped";
    protected $primaryKey = "cod_recomendacion_ped";
    protected $fillable = [
        "nom_recomendacion_ped", "detalle_recomendacion_ped",
        "tipo_recomendacion_area"
    ];

    public function area(){
        return $this->hasMany(Area::class,
            'cod_area',
            'tipo_recomendacion_area');
    }
}
