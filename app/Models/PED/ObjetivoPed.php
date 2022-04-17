<?php

namespace App\Models\PED;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoPed extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "objetivo_ped";
    protected $primaryKey = "cod_objetivo_ped";
    protected $fillable = [
        "cod_objetivo_general", "nom_objetivo", "detalle_objetivo"
    ];



    public function cod_objetivo_general(){
        return $this->hasMany(ObjetivosGeneralesPed::class,
            'cod_objetivo_general',
            'cod_objetivo_general');
    }

    public function nom_objetivo_general(){
        return $this->hasMany(ObjetivosGeneralesPed::class,
            'cod_objetivo_general',
            'cod_objetivo_general');
    }
}
