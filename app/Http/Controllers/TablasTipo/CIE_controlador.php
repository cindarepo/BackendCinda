<?php

namespace App\Http\Controllers\TablasTipo;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\Cie_audiologico;

class CIE_controlador extends Controller
{
    public function getInfo(){
        $data = Cie_audiologico::All();
        return response()->json($data, 201);
    }

    public function store(Request $request)
    {
        $data = Cie_audiologico::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id)
    {
        Cie_audiologico::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(Cie_audiologico $audiologico)
    {
        $audiologico->delete();
        return response()->json(null, 204);
    }


    public function show($id)
    {
        $object = Cie_audiologico::find($id);
        return response()->json($object,201);
    }
}
