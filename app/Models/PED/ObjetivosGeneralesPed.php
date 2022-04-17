<?php

namespace App\Models\PED;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivosGeneralesPed extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "objetivo_general";
    protected $primaryKey = "cod_objetivo_general";
    protected $fillable = [
        "cod_objetivo_tipo", "nom_objetivo_general", "detalle_objetivo_general"
    ];

    public function cod_objetivo_tipo(){
        return $this->hasMany(ObjetivoTipoPed::class,
            'cod_objetivo_tipo',
            'cod_objetivo_tipo');
    }
    

    public function nom_objetivo_tipo(){
        return $this->hasMany(ObjetivoTipoPed::class,
            'cod_objetivo_tipo',
            'cod_objetivo_tipo');
    }
}
