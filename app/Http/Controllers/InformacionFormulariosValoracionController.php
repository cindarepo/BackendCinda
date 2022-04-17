<?php

namespace App\Http\Controllers;

use App\Models\InformacionFormulariosValoracion;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InformacionFormulariosValoracionController extends Controller
{
    public function storeLocal($informacion)
    {
        $informacionInformacion = InformacionFormulariosValoracion::create($informacion);
        return $informacionInformacion;
    }

    public function updateLocal($informacion, $id)
    {
        $informacionInformacion = InformacionFormulariosValoracion::find($id)->update($informacion);
        return $informacionInformacion;
    }
}
