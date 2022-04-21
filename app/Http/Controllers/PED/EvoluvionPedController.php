<?php

namespace App\Http\Controllers\PED;

use Illuminate\Routing\Controller;
use App\Models\PED\EvolucionPed;
use Illuminate\Http\Request;

class EvoluvionPedController extends Controller
{

    public function serviceGetInfoxcodusuario($id){
        $data = $this->getInfoXCodUsuario($id);
        return response()->json($data, 201);
    }
    public function serviceGetInfoxevolucion($id){
        $data = $this->getInfoXevolucion($id);
        return response()->json($data, 201);
    }




    public function getInfoXevolucion($id) {
        return EvolucionPed::with('cod_usuario_panda','cod_mes','numero_sesiones')
            ->where('cod_evolucion_mensual_ped','=',$id)->get();
    }

    public function getInfoXCodUsuario($id) {
        return EvolucionPed::with('cod_usuario_panda','cod_mes','numero_sesiones')
            ->where('cod_usuario_panda','=',$id)->get();
    }

    public function storeLocal($informacion)
    {
        $informacionEvolucion = EvolucionPed::create($informacion);
        return $informacionEvolucion;
    }
    public function store(Request $request)
    {
        $data = EvolucionPed::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        EvolucionPed::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

}
