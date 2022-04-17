<?php

namespace App\Http\Controllers\TablasTipo;

use App\Models\TipoDocumentoFisico;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\Area;

class AreasControlador extends Controller
{
    public function getInfo()
    {
        $data = Area::All();
        return response()->json($data, 201);
    }

    public function store(Request $request)
    {
        $data = Area::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id)
    {
        Area::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(Areas $sexo)
    {
        $sexo->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = Area::find($id);
        return response()->json($object,201);
    }
}
