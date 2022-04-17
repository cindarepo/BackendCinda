<?php

namespace App\Http\Controllers;

use App\Models\InformacionVivienda;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class InformacionViviendaController extends Controller
{
    public function index()
    {
        $data = InformacionVivienda::All();
        return response()->json($data, 201);
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $informacion = InformacionVivienda::create($request->input());
        return response($informacion, 201);
    }

    public function storeLocal( $vivienda)
    {
        $informacion = InformacionVivienda::create($vivienda);
        return $informacion;
    }

    public function updateLocal($vivienda, $id)
    {
        $informacion = InformacionVivienda::find($id)->update($vivienda);
        return $informacion;
    }

    public function update(Request $request, $id)
    {
        InformacionVivienda::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function destroy(InformacionVivienda $informacion)
    {
        //
    }
}
