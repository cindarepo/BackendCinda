<?php

namespace App\Http\Controllers\PED;

use Illuminate\Routing\Controller;
use App\Models\PED\RegistroPed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroPedController extends Controller
{
    /**public function getInfoxcodEvolucion($codEvolucion){
        $data = RegistroPed::with('cod_evolucion_ped','cod_usuario_panda','estado_registro_ped','cod_horario_sesion')
        ->where('cod_evolucion_ped','=', $codEvolucion)->get();
        return response()->json($data, 201);
    }**/

    public function getInfoxcodEvolucion($codEvolucion, $id){
        $data = RegistroPed::with('cod_evolucion_ped','cod_usuario_panda','estado_registro_ped','cod_horario_sesion')
            ->whereRaw('cod_evolucion_ped = ? and estado_registro_ped = ?', [$codEvolucion, $id])->get();
        return response()->json($data, 201);
    }

    public function getSesionPed($cod_ped){
        $data = RegistroPed::with('cod_evolucion_ped','cod_usuario_panda','estado_registro_ped','cod_horario_sesion')
            ->where('cod_registro_ped','=', $cod_ped)->first();
        return response()->json($data, 201);
    }

    public function getPedAcumuladosxCodUsuarioxArea($cod_usuario, $area){
        $data = DB::select('select * from ped_nino where estado_registro_ped = 2 and cod_usuario_panda = ? and cod_area_general=?', [$cod_usuario,$area]);
        return response()->json($data, 201);
    }

    public function store(Request $request)
    {
        $data = RegistroPed::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function storeLocal($informacion)
    {
        $informacionPED = RegistroPed::create($informacion);
        return $informacionPED;
    }
    public function updateLocal($informacion, $id)
    {
        return RegistroPed::find($id)->update($informacion);
    }
}
