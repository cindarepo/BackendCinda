<?php

namespace App\Models\PED;

use App\Models\EntidadesTipo\Area;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoTipoPed extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "objetivo_tipo";
    protected $primaryKey = "cod_objetivo_tipo";
    protected $fillable = [
         "cod_area", "nom_objetivo_tipo", "detalle_objetivo_tipo"
    ];



    public function nom_area(){
        return $this->hasMany(Area::class,
            'cod_area',
            'cod_area');
    }

    public function cod_area_general(){
        return $this->hasMany(Area::class,
            'cod_area',
            'cod_area');
    }

}
