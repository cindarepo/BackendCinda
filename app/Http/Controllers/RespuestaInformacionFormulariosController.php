<?php

namespace App\Http\Controllers;

use App\Models\RespuestaInformacionFormularios;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RespuestaInformacionFormulariosController extends Controller
{
    public function storeLocal($infoUsuario)
    {
        $respuestas = RespuestaInformacionFormularios::create($infoUsuario);
        return $respuestas;
    }

    public function updateLocal($infoUsuario, $id)
    {
        return RespuestaInformacionFormularios::find($id)->update($infoUsuario);
    }
}
