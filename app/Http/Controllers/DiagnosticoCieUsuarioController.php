<?php

namespace App\Http\Controllers;

use App\Models\DiagnosticoCieUsuario;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DiagnosticoCieUsuarioController extends Controller
{
    public function storeLocal($informacion)
    {
        $informacionCie = DiagnosticoCieUsuario::create($informacion);
        return $informacionCie;
    }

    public function updateLocal($informacion, $id)
    {
        $informacionCie = DiagnosticoCieUsuario::find($id)->update($informacion);
        return $informacionCie;
    }
}
