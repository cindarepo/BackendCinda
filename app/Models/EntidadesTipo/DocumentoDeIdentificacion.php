<?php

namespace App\Models\EntidadesTipo;

use App\Models\InformacionPersonalPanda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DocumentoDeIdentificacion extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "tipo_documento_identificacion";
    protected $primaryKey = "cod_tipo_documento_identificacion";
    protected $fillable = [
        'nom_tipo_documento_identificacion',
        'value_tipo_documento_identificacion',
        'status_tipo_documento_identificacion'
    ];

    public function informacionPandaDocumento(){
        return $this->belongsTo(InformacionPersonalPanda::class,
            'cod_tipo_documento_identificacion',
            'panda_tipo_documento');
    }

}
