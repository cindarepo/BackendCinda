<?php

namespace App\Http\Controllers\PED;

use App\Models\PED\CantidadSesionesUsuario;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CantidadSesionesUsuarioController extends Controller
{
    public function getInfo(){
        $data = CantidadSesionesUsuario::All();
        return response()->json($data, 201);
    }

    public function storeLocal($informacion)
    {
        $informacionSesiones = CantidadSesionesUsuario::create($informacion);
        return $informacionSesiones;
    }
    public function store(Request $request)
    {
        $data = CantidadSesionesUsuario::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function updateLocal($info, $id)
    {
        $informacion = CantidadSesionesUsuario::find($id)->update($info);
        return $informacion;
    }

    public function getSesionesAnterior($idUsuarioPanda)
    {
        return DB::select('select * from cantidad_sesiones_usuario where cod_usuario_panda =?
        ORDER BY cod_cantidad_sesiones_usuario DESC LIMIT 1', [$idUsuarioPanda]);
    }



}
