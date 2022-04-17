<?php

namespace App\Http\Controllers;

use App\Models\ProfesionalCinda;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProfesionalController extends Controller
{
    public function getInfo()
    {
        $data = ProfesionalCinda::with('cod_personal_cinda',
            'cod_personal_cinda.cod_informacion_personal_empleado',
            'cod_personal_cinda.cod_informacion_personal_empleado.empleado_sexo_biologico',
            'cod_personal_cinda.cod_informacion_personal_empleado.empleado_tipo_documento',
            'cod_area',
            'cod_personal_cinda.cod_usuario_aplicativo',
            'cod_personal_cinda.cod_informacion_complementaria_empleado',
            'cod_personal_cinda.cod_informacion_complementaria_empleado.complementaria_administrador_plan_beneficios',
            'cod_personal_cinda.cod_informacion_complementaria_empleado.complementaria_caja_compensacion',
            'cod_personal_cinda.cod_informacion_complementaria_empleado.complementaria_fondo_pension',
            'cod_personal_cinda.cod_informacion_complementaria_empleado.complementaria_administradora_riesgo_laboral',

            'cod_personal_cinda.cod_estado_personal'
        )->get();
        return response()->json($data, 201);
    }

    public function getInfoxcod($id)
    {
        $data = ProfesionalCinda::with('cod_personal_cinda',
            'cod_personal_cinda.cod_informacion_personal_empleado',
            'cod_personal_cinda.cod_informacion_personal_empleado.empleado_sexo_biologico',
            'cod_personal_cinda.cod_informacion_personal_empleado.empleado_tipo_documento',
            'cod_area',

            'cod_personal_cinda.cod_informacion_complementaria_empleado',
            'cod_personal_cinda.cod_informacion_complementaria_empleado.complementaria_administrador_plan_beneficios',
            'cod_personal_cinda.cod_informacion_complementaria_empleado.complementaria_caja_compensacion',
            'cod_personal_cinda.cod_informacion_complementaria_empleado.complementaria_fondo_pension',
            'cod_personal_cinda.cod_informacion_complementaria_empleado.complementaria_administradora_riesgo_laboral',
        )->where('cod_profesional_cinda', '=', $id)->first();

        return response()->json([
            'message' => "Consulta finalizada con éxito",
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function getInfoxcodArea($id)
    {
        $data = ProfesionalCinda::with('cod_personal_cinda',
            'cod_personal_cinda.cod_informacion_personal_empleado',
            'cod_personal_cinda.cod_informacion_personal_empleado.empleado_sexo_biologico',
            'cod_personal_cinda.cod_informacion_personal_empleado.empleado_tipo_documento',
            'cod_area',
        )->where('cod_area', '=', $id)->get();
        return response()->json($data, 201);
    }


    public function store(Request $request)
    {
        $area = ProfesionalCinda::create($request->input());
        return response($area, 201);
    }

    public function storeLocal($infoProfesional)
    {
        $infoProfesional = ProfesionalCinda::create($infoProfesional);
        return $infoProfesional;
    }

    public function updateLocal($info, $id)
    {
        return ProfesionalCinda::find($id)->update($info);
    }


    public function show($id)
    {
        $object = ProfesionalCinda::find($id);
        return response()->json($object, 201);
    }
}
