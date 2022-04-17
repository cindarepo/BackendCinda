<?php

namespace App\Http\Controllers;

use App\Models\DocumentoUsuarioPanda;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class DocumentoUsuarioPandaController extends Controller
{
    public function storeLocal($informacion)
    {
        $informacionDocumento = DocumentoUsuarioPanda::create($informacion);
        return $informacionDocumento;
    }

    public function verificarTipoDocumento($d){

    }

    public function updateLocal($informacion, $id)
    {
        $informacionDocumento = DocumentoUsuarioPanda::find($id)->update($informacion);
        return $informacionDocumento;
    }

    public function getDocumentos($id){
        $data = DocumentoUsuarioPanda::with('cod_tipo_documento_fisico')
            ->where('cod_usuario_panda','=',$id)->get();
        return response()->json($data, 201);
    }
}
