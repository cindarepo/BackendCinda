<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Entrevista;
use Illuminate\Http\Request;

class EntrevistaController extends Controller
{
    public function index()
    {
        $data = Entrevista::All();
        return response()->json($data, 201);
    }

    public function store(Request $request)
    {
        $entrevista = Entrevista::create($request->input());
        return response($entrevista, 201);
    }

    public function storeLocal($informacion)
    {
        return Entrevista::create($informacion);
    }

    public function updateLocal($informacion, $id)
    {
        return Entrevista::find($id)->update($informacion);
    }


    public function update(Request $request, $id)
    {
        Entrevista::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function destroy(TipoDocumentoFisico $tipoDocumentoFisico)
    {
        //
    }
}
