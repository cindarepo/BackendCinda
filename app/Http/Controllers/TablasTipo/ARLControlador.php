<?php

namespace App\Http\Controllers\TablasTipo;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\AdministradoraRiesgosLaborales;

class ARLControlador extends Controller
{
    public function getInfo(){
        $data = AdministradoraRiesgosLaborales::All();
        return response()->json($data, 201);
    }
    public function store(Request $request)
    {
        $data = AdministradoraRiesgosLaborales::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $data = AdministradoraRiesgosLaborales::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function delete(AdministradoraRiesgosLaborales $arl)
    {
        $data = $arl->delete();
        return response()->json([
            'message' => "Successfully deleted",
            'success' => $data
        ], 200);
    }

    public function show($id)
    {
        $object = AdministradoraRiesgosLaborales::find($id);
        return response()->json([
            'message' => "Successfully deleted",
            'success' => true,
            'data' => $object
        ], 200);
    }
}
