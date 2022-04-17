<?php

namespace App\Http\Controllers\PED;


use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\PED\ActividadPed;

class ActividadPedController extends Controller
{

    public function getInfo(){
        $data = ActividadPed::All();
        return response()->json($data, 201);
    }
    public function store(Request $request)
    {
        $data = ActividadPed::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {

        ActividadPed::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(ActividadPed $actividadPed)
    {
        $actividadPed->delete();
        return response()->json(null, 204);
    }

    public function getActividadXobjetivoGeneral($id){
        $data = ActividadPed::with('relacion_cod_objetivo',
        )->where('cod_objetivo_general','=',$id)->get();
        return response()->json($data, 200);
    }
}
