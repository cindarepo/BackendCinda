<?php

namespace App\Http\Controllers;

use App\Models\DiagnosticoCifUsuario;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DiagnosticoCifUsuarioController extends Controller
{
    public function storeLocal($informacion)
    {
        $informacionCif = DiagnosticoCifUsuario::create($informacion);
        return $informacionCif;
    }

    public function updateLocal($cif, $id)
    {
        $informacion = DiagnosticoCifUsuario::find($id)->update($cif);
        return $informacion;
    }
}
