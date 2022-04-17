<?php

namespace App\Http\Controllers\TablasTipo;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\MunicipioDeResidencia;

class MunicipioResidenciaControlador extends Controller
{
    public function getInfo(){
        $data = MunicipioDeResidencia::All();
        return response()->json($data, 201);
    }
    public function store(Request $request)
    {
        $data = MunicipioDeResidencia::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {

        MunicipioDeResidencia::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(MunicipioDeResidencia $municipioDeResidencia)
    {
        $municipioDeResidencia->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = MunicipioDeResidencia::find($id);
        return response()->json($object,201);
    }

}
