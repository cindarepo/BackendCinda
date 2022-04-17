<?php

namespace App\Http\Controllers\PED;

use App\Models\PED\ObjetivosGeneralesPed;
use Illuminate\Routing\Controller;
use App\Models\PED\ObjetivoPed;
use Illuminate\Http\Request;

class ObjetivoPedController extends Controller
{
    public function getInfo(){
        $data = ObjetivoPed::with('nom_objetivo_general')->get();
        $codi=0;
        foreach ($data as $fila) {
            $json =  json_decode($fila['nom_objetivo_general']);
            $data[$codi]['cod_objetivo_general'] = $json[0]->nom_objetivo_general;
            $codi++;
        }
        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
        $data = ObjetivoPed::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        ObjetivoPed::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(ObjetivoPed $ObjetivoPed)
    {
        $ObjetivoPed->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = ObjetivoPed::find($id);
        return response()->json($object,201);
    }

    public function getObjetivoPed_objetivoGeneral($id){
        $data = ObjetivoPed::with('cod_objetivo_general',
        )->where('cod_objetivo_general','=',$id)->get();
        return response()->json($data, 200);
    }
}
