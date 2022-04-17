<?php

namespace App\Http\Controllers\TablasTipo;

use App\Models\EntidadesTipo\EstandarCie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EstandarCieControlador extends Controller
{
    public function getInfo()
    {
        $data = Estandarcie::orderBy('nom_estandar_cie')->get();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $data = Estandarcie::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id)
    {
        Estandarcie::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(Estandarcie $estandarcie)
    {
        $estandarcie->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = Estandarcie::find($id);
        return response()->json($object,201);
    }
}
