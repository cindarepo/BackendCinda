<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesionalesFirmas extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "profesionales_firmas";
    protected $primaryKey = "cod_profesional_firma";
    protected $fillable = [
    "cod_profesional",
    "firma_profesional"
    ];
}
