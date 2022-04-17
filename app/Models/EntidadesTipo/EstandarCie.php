<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estandarcie extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "estandar_cie";
    protected $primaryKey = "cod_estandar_cie";
    protected $fillable = [
            "nom_estandar_cie",
            "value_estandar_cie",
            "status_estandar_cie"
    ];

}
