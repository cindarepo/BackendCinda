<?php

namespace App\Http\Controllers\TablasTipo;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\TipoDePerdidaAuditiva;

class TipoPerdidaAuditivaControlador extends Controller
{
    public function getInfo(){
        $data = TipoDePerdidaAuditiva::All();
        return response()->json($data, 201);
    }
    public function store(Request $request)
    {
        $data = TipoDePerdidaAuditiva::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        TipoDePerdidaAuditiva::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(TipoDePerdidaAuditiva $proceso)
    {
        $proceso->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = TipoDePerdidaAuditiva::find($id);
        return response()->json($object,201);
    }
}
