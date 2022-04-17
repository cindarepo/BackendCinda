<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDiagnostico extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tipo_diagnostico";
    protected $primaryKey = "cod_tipo_diagnostico";
    protected $fillable = [
        "nom_tipo_diagnostico"
    ];
}
