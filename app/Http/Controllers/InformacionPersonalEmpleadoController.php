<?php

namespace App\Http\Controllers;

use App\Models\InformacionPersonalEmpleado;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InformacionPersonalEmpleadoController extends Controller
{

    public function storeLocal($informacion)
    {
        $informacionPersonal = InformacionPersonalEmpleado::create($informacion);
        return $informacionPersonal;
    }

    public function updateLocal($info, $id)
    {
        $informacion = InformacionPersonalEmpleado::find($id)->update($info);
        return $informacion;
    }


}
