<?php

namespace App\Http\Controllers;

use App\Models\UsuarioPanda;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class UsuarioPandaController extends Controller
{
    public function getInfo($tipo)
    {
        if($tipo == 1){
            $data = UsuarioPanda::with('panda_informacion_personal.panda_sexo_biologico',
                'panda_tipo_proceso',
                'panda_informacion_personal.panda_pais_nacimiento',
                'panda_informacion_personal.panda_informacion_vivienda',
                'panda_informacion_personal.panda_tipo_documento','panda_cod_status_usuario', 'orden_medica',
                'referencias','referencias.relacionParentesco.parentesco','referencias.referido_informacion_vivienda',
                'referencias.referido_tipo_documento','panda_plan_beneficios', 'panda_plan_beneficios.relacionEpsUsuario',
                'cirugias')
                    ->orwhere('panda_cod_status_usuario','=', 1)
                    ->orWhere('panda_cod_status_usuario','=', 2)
                    ->orWhere('panda_cod_status_usuario','=',3)
                    ->orWhere('panda_cod_status_usuario','=', 4)->get();
        }else{
            $data = UsuarioPanda::with('panda_informacion_personal.panda_sexo_biologico',
                'panda_tipo_proceso',
                'panda_informacion_personal.panda_pais_nacimiento',
                'panda_informacion_personal.panda_informacion_vivienda',
                'panda_informacion_personal.panda_tipo_documento','panda_cod_status_usuario', 'orden_medica',
                'referencias','referencias.relacionParentesco.parentesco','referencias.referido_informacion_vivienda',
                'referencias.referido_tipo_documento','panda_plan_beneficios', 'panda_plan_beneficios.relacionEpsUsuario',
                'cirugias')
                ->orwhere('panda_cod_status_usuario','=', 5)
                ->orWhere('panda_cod_status_usuario','=', 6)
                ->orWhere('panda_cod_status_usuario','=',7)
                ->orWhere('panda_cod_status_usuario','=', 8)->get();
        }

        return response()->json($data, 200);
    }

    public function getEntrevista($id)
    {
        $data = UsuarioPanda::with('panda_informacion_personal.panda_sexo_biologico',
            'panda_informacion_personal.panda_pais_nacimiento', 'panda_plan_beneficios',
            'panda_informacion_personal.panda_informacion_vivienda',
            'panda_informacion_personal.panda_tipo_documento',
            'entrevista', 'entrevista.entrevista_panda_personal.cod_informacion_personal_empleado',
            'cirugias'

        )->where('cod_usuario_panda','=',$id)->get();
        return response()->json($data, 201);
    }

    public function getDiagnostico($id){
        $data = UsuarioPanda::with('diagnosticos_cie', 'diagnosticos_cie.cod_tipo_diagnostico', 'diagnosticos_cie.cod_estandar_cie',
            'diagnosticos_cif',
            'diagnosticos_cif.cod_tipo_diagnostico',
        )->where('cod_usuario_panda','=',$id)->first();
        return response()->json([
            'message' => "¡Consulta exitosa!",
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function getInfoUsuarioxcod($id)
    {
        $data = UsuarioPanda::with('panda_informacion_personal.panda_sexo_biologico',
            'panda_tipo_proceso', 'panda_tipo_perdida','panda_grado_perdida',
            'panda_informacion_personal.panda_pais_nacimiento',
            'panda_informacion_personal.panda_informacion_vivienda',
            'panda_informacion_personal.panda_informacion_vivienda.cod_municipio',
            'panda_informacion_personal.panda_tipo_documento','panda_cod_status_usuario', 'orden_medica',
            'referencias','referencias.relacionParentesco.parentesco','referencias.referido_informacion_vivienda',
            'referencias.referido_tipo_documento', 'panda_plan_beneficios')->where('cod_usuario_panda','=',$id)->get();
        return response()->json($data, 201);
    }


    public function store(Request $request)
    {
        $area = UsuarioPanda::create($request->input());
        return response($area, 201);
    }
    public function storeLocal( $infoUsuario)
    {
        $usuario = UsuarioPanda::create($infoUsuario);
        return $usuario;
    }

    public function cambiarEstadoUsuarioPanda($id, $cod){
        $objeto['panda_cod_status_usuario'] = $cod;
        $data = $this->updateLocal($objeto, $id);

        return response()->json([
            'message' => "Successfully updated",
            'success' => $data
        ], 200);
    }
    public function updateLocal($infoUsuario, $id)
    {
        return UsuarioPanda::find($id)->update($infoUsuario);
    }
    public function update(Request $request, $id)
    {
        UsuarioPanda::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function getAsignacionPaciente($id)
    {
        $asignacion = DB::select('select cod_asignacion_profesionales
                                    from asignacion_profesionales
                                    where asignacion_profesionales.cod_nino_panda = ?', [$id]);
        return response()->json($asignacion,201);
    }

}
