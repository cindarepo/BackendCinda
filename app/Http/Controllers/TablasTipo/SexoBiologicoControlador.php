<?php

namespace App\Http\Controllers\TablasTipo;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\SexoBiologico;

class SexoBiologicoControlador extends Controller
{
    public function getInfo()
    {
        $data = SexoBiologico::with('informacionPanda')->get();
        return response()->json($data, 201);
    }

    public function store(Request $request)
    {
        $data = SexoBiologico::created($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = SexoBiologico::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(SexoBiologico $sexo)
    {
        $sexo->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = SexoBiologico::find($id);
        return response()->json($object, 201);
    }
}
