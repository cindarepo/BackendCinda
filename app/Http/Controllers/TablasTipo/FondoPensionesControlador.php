<?php

namespace App\Http\Controllers\TablasTipo;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\FondoDePensiones;

class FondoPensionesControlador extends Controller
{
    public function getInfo(){
        $data = FondoDePensiones::All();
        return response()->json($data, 201);
    }
    public function store(Request $request)
    {
        $data = FondoDePensiones::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $data = FondoDePensiones::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function delete(FondoDePensiones $arl)
    {
        $data = $arl->delete();
        return response()->json([
            'message' => "Successfully deleted",
            'success' => $data
        ], 200);
    }

    public function show($id)
    {
        $object = FondoDePensiones::find($id);
        return response()->json([
            'message' => "Successfully deleted",
            'success' => true,
            'data' => $object
        ], 200);
    }
}
