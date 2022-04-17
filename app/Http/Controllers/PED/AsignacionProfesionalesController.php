<?php

namespace App\Http\Controllers\PED;

use App\Models\PED\AsignacionProfesionales;
use Illuminate\Routing\Controller;
use App\Models\PED\RecomendacionPed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignacionProfesionalesController extends Controller
{
    public function getInfoUsuariosxProfesional($idProfesional){

        $data = DB::select('call pacientesxprofesionales(?);', [$idProfesional]);
        return response()->json($data, 201);
    }

    public function getAsignacionByNinoPanda($idPatient) {
        $data = AsignacionProfesionales
            ::where('cod_nino_panda', $idPatient)
            ->with(
                'cod_habla','cod_habla.cod_personal_cinda', 'cod_habla.cod_personal_cinda.cod_informacion_personal_empleado',
                'cod_psicologa','cod_psicologa.cod_personal_cinda', 'cod_psicologa.cod_personal_cinda.cod_informacion_personal_empleado',
                'cod_fonoaudiologa','cod_fonoaudiologa.cod_personal_cinda', 'cod_fonoaudiologa.cod_personal_cinda.cod_informacion_personal_empleado',
                'cod_musica','cod_musica.cod_personal_cinda', 'cod_musica.cod_personal_cinda.cod_informacion_personal_empleado',
                'cod_teo','cod_teo.cod_personal_cinda', 'cod_teo.cod_personal_cinda.cod_informacion_personal_empleado',
                'cod_fisioterapia','cod_fisioterapia.cod_personal_cinda', 'cod_fisioterapia.cod_personal_cinda.cod_informacion_personal_empleado',
            )->first();

        return response()->json([
            'message' => '¡Consulta exitosa!',
            'data' => $data,
            'success' => true
        ], 200);
    }


    public function getAsignacion($id){
        $data = DB::select('select * from vista_asignacion_profesionales where cod_asignacion_profesionales =?', [$id]);
        return response()->json($data, 201);
    }




    public function createlocal($info)
    {
        $asignacion = AsignacionProfesionales::create($info);
        return $asignacion;
    }
    public function updateLocal($info, $id)
    {
        return AsignacionProfesionales::where('cod_nino_panda', $id)->update($info);
    }


    public function update(Request $request, $id)
    {
        AsignacionProfesionales::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }



}
