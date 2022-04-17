<?php

namespace App\Http\Controllers\PED;


use Illuminate\Routing\Controller;
use App\Models\PED\DescripcionInicioPed;
use Illuminate\Http\Request;

class DescripcionInicioPedController extends Controller
{
    public function getInfo(){
        $data = DescripcionInicioPed::All();
        return response()->json($data, 201);
    }
    public function store(Request $request)
    {
        $data = DescripcionInicioPed::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        DescripcionInicioPed::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(DescripcionInicioPed $DescripcionInicioPed)
    {
        $DescripcionInicioPed->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = DescripcionInicioPed::find($id);
        return response()->json($object,201);
    }
}
