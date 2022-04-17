<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProfesional extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "TipoProfesional";
    protected $primaryKey = "cod_TipoProfesional";
    protected $fillable = [
        'cod_TipoProfesional',
        'nom_TipoProfesional',
        'value_TipoProfesional',
        'status_TipoProfesional'
    ];
}
