<?php

namespace App\Http\Controllers;

use App\Models\EpsUsuarioPanda;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class EpsUsuarioPandaController extends Controller
{
    public function storeLocal($informacion)
    {
        return EpsUsuarioPanda::create($informacion);
    }

    public function buscarEps($idPanda){
        $ninoPanda = DB::select('select cod_administrador_plan_beneficios, cod_eps_usuarios from eps_usuario_panda where
                                     cod_usuario_panda =?  and estado_eps_usuario=1' , [$idPanda]);
    }

    public function updateLocal($info, $id)
    {
        return EpsUsuarioPanda::find($id)->update($info);
    }

}
