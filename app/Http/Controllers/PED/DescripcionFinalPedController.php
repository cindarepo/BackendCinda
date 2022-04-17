<?php

namespace App\Http\Controllers\PED;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\PED\DescripcionFinalPed;

class DescripcionFinalPedController extends Controller
{
    public function getInfo(){
        $data = DescripcionFinalPed::All();
        return response()->json($data, 201);
    }
    public function store(Request $request)
    {
        $data = DescripcionFinalPed::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        DescripcionFinalPed::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(DescripcionFinalPed $DescripcionFinalPed)
    {
        $DescripcionFinalPed->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = DescripcionFinalPed::find($id);
        return response()->json($object,201);
    }
}
