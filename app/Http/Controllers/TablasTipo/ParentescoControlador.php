<?php

namespace App\Http\Controllers\TablasTipo;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\Parentesco;

class ParentescoControlador extends Controller
{
    public function getInfo()
    {
        $data = Parentesco::All();
        return response()->json($data, 201);
    }

    public function store(Request $request)
    {
        $data = Parentesco::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }

    public function update(Request $request, $id)
    {

        Parentesco::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(Parentesco $sexo)
    {
        $sexo->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = Parentesco::find($id);
        return response()->json($object, 201);
    }
}
