<?php

namespace App\Http\Controllers\TablasTipo;

use App\Models\EntidadesTipo\DocumentoDeIdentificacion;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;



class DocumentoIdentificacionControlador extends Controller
{
    public function getInfo(){
        $data = DocumentoDeIdentificacion::All();
        return response()->json($data, 201);
    }

    public function store(Request $request)
    {
        $data = DocumentoDeIdentificacion::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id)
    {
        DocumentoDeIdentificacion::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(DocumentoDeIdentificacion $sexo)
    {
        $sexo->delete();
        return response()->json(null, 204);
    }
}
