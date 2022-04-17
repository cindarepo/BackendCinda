<?php

namespace App\Models\EntidadesTipo;

use App\Models\UsuarioPanda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaCompensacion extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "caja_compensacion";
    protected $primaryKey = "cod_caja_compensacion";
    protected $fillable = [
        "nom_caja_compensacion",
        "value_caja_compensacion"
    ];


}
