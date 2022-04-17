<?php

namespace App\Http\Controllers\TablasTipo;

use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\TipoDocumentoFisico;
use Illuminate\Http\Request;

class TipoDocumentoFisicoController extends Controller
{

    public function index()
    {
        $data = TipoDocumentoFisico::All();
        return response()->json($data, 200);
    }

    public function create()
    {
        //
    }
   public function store(Request $request)
    {
        $data = TipoDocumentoFisico::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }

    public function show(TipoDocumentoFisico $tipoDocumentoFisico)
    {
        //
    }

    public function edit(TipoDocumentoFisico $tipoDocumentoFisico)
    {

    }


    public function update(Request $request, $id)
    {
        TipoDocumentoFisico::find($id)->update($request->input());
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
