<?php

namespace App\Http\Controllers\TablasTipo;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\TipoProceso;

class TipoProcesoControlador extends Controller
{
    public function getInfo(){
        $data = TipoProceso::All();
        return response()->json($data, 201);
    }
    public function store(Request $request)
    {
        $data = TipoProceso::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        TipoProceso::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(TipoProceso $proceso)
    {
        $proceso->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = TipoProceso::find($id);
        return response()->json($object,201);
    }
}
