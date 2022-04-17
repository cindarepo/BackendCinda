<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDiagnostico extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "tipo_diagnostico";
    protected $primaryKey = "cod_tipo_diagnostico";
    protected $fillable = [
            "nom_tipo_diagnostico",
    ];

}
