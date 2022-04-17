<?php

namespace App\Http\Controllers;

use App\Models\InformacionComplementariaEmpleado;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class InformacionComplementariaEmpleadoController extends Controller
{
    public function store(Request $request)
    {
        $area = InformacionComplementariaEmpleado::create($request->input());
        return response($area, 201);
    }
    public function storeLocal($infoProfesional)
    {
        $infoComplementaria = InformacionComplementariaEmpleado::create($infoProfesional);
        return $infoComplementaria;
    }

    public function updateLocal($info, $id)
    {
        $infoProfesional= InformacionComplementariaEmpleado::find($id)->update($info);
        return $infoProfesional;
    }

    public function delete(InformacionComplementariaEmpleado $usu)
    {
        $usu->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = InformacionComplementariaEmpleado::find($id);
        return response()->json($object,201);
    }
}
