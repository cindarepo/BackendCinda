<?php

namespace App\Http\Controllers\PED;

use Illuminate\Routing\Controller;
use App\Models\PED\RecomendacionPed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecomendacionPedController extends Controller
{
    public function getInfo(){
        $data = RecomendacionPed::with('area')->get();
        $cont =0;
        foreach ($data as $fila) {
            $json =  json_decode($fila['area']);
            $data[$cont]['tipo_recomendacion_area'] = $json[0]->nom_area;
            $cont++;
        }
        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
        $data = RecomendacionPed::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        RecomendacionPed::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(RecomendacionPed $RecomendacionPed)
    {
        $RecomendacionPed->delete();
        return response()->json(null, 204);
    }


    public function getRecomendacionXarea(){
        $horarios = DB::select('select * from recomendacion_ped');
        return response()->json($horarios, 200);
    }
}
