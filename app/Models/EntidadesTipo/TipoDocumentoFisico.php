<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumentoFisico extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "tipo_documento_fisico";
    protected $primaryKey = "cod_tipo_documento_fisico";
    protected $fillable = [
        'nom_tipo_documento_fisico',
        'value_tipo_documento_fisico',
        'status_tipo_documento_fisico',
        'requerido_tipo_documento_fisco'
    ];
}
