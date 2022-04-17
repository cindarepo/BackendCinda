<?php

namespace App\Http\Controllers\PED;

use Illuminate\Routing\Controller;
use App\Models\PED\ObjetivosGeneralesPed;
use Illuminate\Http\Request;

class ObjetivosGeneralesPedController extends Controller
{
    public function getInfo(){
        $data = ObjetivosGeneralesPed::with('nom_objetivo_tipo')->get();
        $cont=0;
        foreach ($data as $fila) {
            $json =  json_decode($fila['nom_objetivo_tipo']);
            $data[$cont]['cod_objetivo_tipo'] = $json[0]->nom_objetivo_tipo;
            $cont++;
        }
        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
        $data = ObjetivosGeneralesPed::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        ObjetivosGeneralesPed::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(ObjetivosGeneralesPed $ObjetivosGeneralesPed)
    {
        $ObjetivosGeneralesPed->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = ObjetivosGeneralesPed::find($id);
        return response()->json($object,201);
    }


    public function getObjetivoPed_objetivo_tipo($id){
        $data = ObjetivosGeneralesPed::with('cod_objetivo_tipo',
        )->where('cod_objetivo_tipo','=',$id)->get();
        return response()->json($data, 200);
    }
}
