<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertenenciaDeEtnia extends Model
{

    ## Aun no usada
    public $timestamps = false;
    use HasFactory;
    protected $table = "PertenenciaDeEtnia";
    protected $primaryKey = "cod_PertenenciaDeEtnia";
    protected $fillable = [
        'cod_PertenenciaDeEtnia',
        'nom_PertenenciaDeEtnia',
        'value_PertenenciaDeEtnia',
        'status_PertenenciaDeEtnia'
    ];
}
