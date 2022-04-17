<?php

namespace App\Http\Controllers;

use App\Models\DetallesEncabezadoValoracion;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DetallesEncabezadoValoracionController extends Controller
{
    public function storeLocal($informacion)
    {
        $informacionEncabezado = DetallesEncabezadoValoracion::create($informacion);
        return $informacionEncabezado;
    }

    public function updateLocal($informacion, $id)
    {
        $informacionEncabezado = DetallesEncabezadoValoracion::find($id)->update($informacion);
        return $informacionEncabezado;
    }
}
