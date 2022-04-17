<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    // NO POSEE CONTROLADOR
    public $timestamps = false;
    use HasFactory;
    protected $table = "mes";
    protected $primaryKey = "cod_mes";
    protected $fillable = [
        "nom_mes",
        "value_mes",
        "status_mes"
    ];






}
