<?php

namespace App\Http\Controllers\TablasTipo;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\EntidadPlanDeBeneficios;

class EPSControlador extends Controller
{
    public function getInfo(){
        $data = EntidadPlanDeBeneficios::All();
        return response()->json($data, 201);
    }
    public function store(Request $request)
    {
        $data = EntidadPlanDeBeneficios::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {

        EntidadPlanDeBeneficios::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(EntidadPlanDeBeneficios $sexo)
    {
        $sexo->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = EntidadPlanDeBeneficios::find($id);
        return response()->json($object,201);
    }
}
