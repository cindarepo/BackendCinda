<?php

namespace App\Http\Controllers;

use App\Models\InformacionReferido;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class InformacionReferidoController extends Controller
{
    public function getInfo(){
        $data = InformacionReferido::All();
        return response()->json($data, 201);
    }
    public function storeLocal( $referido)
    {
        return InformacionReferido::create($referido);
    }
    public function updateLocal($info, $id)
    {
        return InformacionReferido::find($id)->update($info);
    }
}
