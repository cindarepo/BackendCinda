<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\InformacionPersonalPanda;
use Illuminate\Http\Request;

class InformacionPersonalPandaController extends Controller
{
    public function index()
    {
        $data = InformacionPersonalPanda::with('panda_sexo_biologico','panda_informacion_vivienda','panda_tipo_documento')->get();
        return response()->json($data, 201);
    }

    public function create()
    {

    }
    public function store(Request $request)
    {
        $informacion = InformacionPersonalPanda::create($request->input());
        return response($informacion, 201);
    }
    public function storeLocal($informacionBasica)
    {
        $informacion = InformacionPersonalPanda::create($informacionBasica);
        return $informacion;
    }
    public function updateLocal($informacionPanda, $id)
    {
        $informacion = InformacionPersonalPanda::find($id)->update($informacionPanda);
        return $informacion;
    }

    public function update(Request $request, $id)
    {
        InformacionPersonalPanda::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function destroy(InformacionPersonalPanda $informacion)
    {
        //
    }
}
