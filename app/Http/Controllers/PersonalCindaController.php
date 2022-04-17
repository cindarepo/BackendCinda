<?php

namespace App\Http\Controllers;

use App\Models\PersonalCinda;
use App\Models\ProfesionalCinda;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PersonalCindaController extends Controller
{

    public function getProfesionalxcodUser($id){
        $data = PersonalCinda::with('profesional_relacion',
            'profesional_relacion.cod_area',
            'cod_informacion_personal_empleado',
            'cod_informacion_personal_empleado.empleado_sexo_biologico',
            'cod_informacion_personal_empleado.empleado_tipo_documento',
            'cod_informacion_complementaria_empleado',
            'cod_informacion_complementaria_empleado.complementaria_administrador_plan_beneficios',
            'cod_informacion_complementaria_empleado.complementaria_caja_compensacion',
            'cod_informacion_complementaria_empleado.complementaria_fondo_pension',
            'cod_informacion_complementaria_empleado.complementaria_administradora_riesgo_laboral',
            'cod_informacion_complementaria_empleado',
            'cod_usuario_aplicativo'
        )->where('cod_usuario_aplicativo','=',$id)->first();

        return response()->json([
            'data' => $data,
            'message' => 'Consulta exitosa.',
            'success' => true
        ], 200);
    }


    public function store(Request $request)
    {
        $area = PersonalCinda::create($request->input());
        return response($area, 201);
    }
    public function storeLocal( $info)
    {
        $infoProfesional = PersonalCinda::create($info);
        return $infoProfesional;
    }

    public function updateLocal($info, $id)
    {
        return PersonalCinda::find($id)->update($info);
    }

    public function cambiarEstadoFuncionario($id, $cod)
    {
        try {
            $objeto['cod_estado_personal'] = $cod;
            $data = $this->updateLocal($objeto, $id);
        }catch (Throwable $e) {
            return response()->json([
                'message' => 'Sucedio un error!',
                'success' => false], 200);
        }
        return response()->json([
            'message' => "Successfully updated",
            'success' => $data
        ], 200);
    }

}
