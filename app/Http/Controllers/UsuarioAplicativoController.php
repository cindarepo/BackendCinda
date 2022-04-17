<?php

namespace App\Http\Controllers;

use App\Models\UsuarioAplicativo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UsuarioAplicativoController extends Controller
{
    public function storeLocal( $infoUsuario)
    {
        $usuario = UsuarioAplicativo::create($infoUsuario);
        return $usuario;
    }

    public function updateLocal($infoUsuario, $id)
    {
        return UsuarioAplicativo::find($id)->update($infoUsuario, $id);
    }
}
