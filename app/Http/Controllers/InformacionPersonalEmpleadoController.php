<?php

namespace App\Http\Controllers;

use App\Models\informacionPersonalEmpleado;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InformacionPersonalEmpleadoController extends Controller
{

    public function storeLocal($informacion)
    {
        $informacionPersonal = informacionPersonalEmpleado::create($informacion);
        return $informacionPersonal;
    }

    public function updateLocal($info, $id)
    {
        $informacion = informacionPersonalEmpleado::find($id)->update($info);
        return $informacion;
    }


}
