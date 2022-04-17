<?php

namespace App\Http\Controllers;

use App\Models\InformacionReferido;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class InformacionReferidoController extends Controller
{
    public function getInfo(){
        $data = InformacionReferido::All();
        return response()->json($data, 201);
    }
    public function store(Request $request)
    {
        InformacionReferido::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true
        ], 200);
    }
    public function storeLocal( $referido)
    {
        return InformacionReferido::create($referido);

    }
    public function update(Request $request, $id)
    {
        InformacionReferido::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(InformacionReferido $proceso)
    {
        $proceso->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = InformacionReferido::find($id);
        return response()->json($object,201);
    }
}
