<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoGradoPerdida extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "grado_perdida_auditiva";
    protected $primaryKey = "cod_grado_perdida_auditiva";
    protected $fillable = [
        'nom_grado_perdida_auditiva',
        'value_grado_perdida_auditiva',
        'status_grado_perdida_auditiva'
    ];
}
