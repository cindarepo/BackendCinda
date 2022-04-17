<?php

namespace App\Http\Controllers;

use App\Models\OrdenMedica;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class OrdenMedicaController extends Controller
{
    public function index()
    {
        $data = OrdenMedica::All();
        return response()->json($data, 201);
    }


    public function getOrdenPaciente(){
        $data = OrdenMedica::All();
        return response()->json($data, 201);
    }

    public function store(Request $request)
    {
        $datosGenerales = $request->json()->all();
        $datosGenerales['estado_orden_medica'] = 1;
        $informacion = OrdenMedica::create($datosGenerales);
        
        return response()->json([
            'message' => '¡Se registro exitosamente!',
            'data' => $informacion,
            'success' => true
        ], 201);
    }

    public function update(Request $request, $id)
    {
        OrdenMedica::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

}
