<?php

namespace App\Http\Controllers\PED;

use App\Models\PED\CantidadSesionesUsuario;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

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
    public function update(Request $request, $id)
    {
        CantidadSesionesUsuario::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }


}
