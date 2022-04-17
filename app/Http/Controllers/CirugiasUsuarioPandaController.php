<?php

namespace App\Http\Controllers;

use App\Models\CirugiasUsuarioPanda;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CirugiasUsuarioPandaController extends Controller
{
    public function storeLocal($informacion)
    {
        $informacionCirugias = CirugiasUsuarioPanda::create($informacion);
        return $informacionCirugias;
    }
    public function updateLocal($informacion, $id)
    {
        $informacionCirugias = CirugiasUsuarioPanda::find($id)->update($informacion);
        return $informacionCirugias;
    }
}
