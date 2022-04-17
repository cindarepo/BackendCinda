<?php

namespace App\Http\Controllers\PED;

use Illuminate\Routing\Controller;
use App\Models\PED\ObjetivoTipoPed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObjetivoTipoPedController extends Controller
{
    public function getInfo(){
        $data = ObjetivoTipoPed::with('nom_area')->get();
        $i=0;
        foreach ($data as $fila) {
            $json =  json_decode($fila['nom_area']);
            $data[$i]['cod_area'] = $json[0]->nom_area;
            $i++;
        }
        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
        $data = ObjetivoTipoPed::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        ObjetivoTipoPed::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(ObjetivoTipoPed $ObjetivoTipoPed)
    {
        $ObjetivoTipoPed->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = ObjetivoTipoPed::find($id);
        return response()->json($object,201);
    }


    public function getObjetivoTipo_area($id){
        $data = ObjetivoTipoPed::with('cod_area_general',
        )->where('cod_area','=',$id)->get();
        return response()->json($data, 200);
    }

    public function getHorarios(){
        $horarios = DB::select('select * from horario_sesion');
        return response()->json($horarios, 200);
    }



    public function getResultadoXarea(){
        $horarios = DB::select('select * from resultado_ped');
        return response()->json($horarios, 200);
    }

}
