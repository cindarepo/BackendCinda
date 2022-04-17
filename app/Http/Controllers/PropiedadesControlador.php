<?php

namespace App\Http\Controllers;

use App\Models\Propiedades;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PropiedadesControlador extends Controller
{

    public function getInfo()
    {
        $object = Propiedades::All();
        return response()->json($object,201);
    }

    public function show($id)
    {
        $object = Propiedades::find($id);
        return response()->json($object,201);
    }

    public function store(Request $request)
    {
        $data = Propiedades::create($request->input());
        return response($data, 201);
    }
    public function storeLocal( $info)
    {
        $data = Propiedades::create($info);
        return $data;
    }

    public function updateLocal($info, $id)
    {
        return Propiedades::find($id)->update($info);
    }

    public function delete(Propiedades $usu)
    {
        $usu->delete();
        return response()->json(null, 204);
    }


}
