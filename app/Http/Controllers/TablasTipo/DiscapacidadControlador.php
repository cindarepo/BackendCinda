<?php

namespace App\Http\Controllers\TablasTipo;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\CategoriaDeDiscapacidad;

class DiscapacidadControlador extends Controller
{
    public function getInfo(){
        $data = CategoriaDeDiscapacidad::All();
        return response()->json($data, 201);
    }
    public function store(Request $request)
    {
        $data = CategoriaDeDiscapacidad::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        CategoriaDeDiscapacidad::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(CategoriaDeDiscapacidad $sexo)
    {
        $sexo->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = CategoriaDeDiscapacidad::find($id);
        return response()->json($object,201);
    }
}
