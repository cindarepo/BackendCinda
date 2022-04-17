<?php

namespace App\Models;

use App\Models\EntidadesTipo\TipoDocumentoFisico;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoUsuarioPanda extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "documentos_usuario_panda";
    protected $primaryKey = "cod_documentos_usuario_panda";
    protected $fillable = [
        "cod_usuario_panda",
        "cod_tipo_documento_fisico",
        "documento_estado_entrega",
        "url_documento"
    ];

    public function cod_tipo_documento_fisico(){
        return $this->hasOne(TipoDocumentoFisico::class,
            'cod_tipo_documento_fisico',
            'cod_tipo_documento_fisico')->select(['cod_tipo_documento_fisico', 'nom_tipo_documento_fisico']);
    }
}




