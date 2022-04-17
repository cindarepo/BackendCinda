<?php

namespace App\Http\Controllers\PED;

use Illuminate\Routing\Controller;
use App\Models\PED\ResultadoPed;
use Illuminate\Http\Request;

class ResultadoPedController extends Controller
{
    public function getInfo(){
        $data = ResultadoPed::All();
        return response()->json($data, 201);
    }
    public function store(Request $request)
    {
        $data = ResultadoPed::create($request->input());
        return response()->json([
            'message' => "Successfully created",
            'success' => true,
            'data' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        ResultadoPed::find($id)->update($request->input());
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }

    public function delete(ResultadoPed $ResultadoPed)
    {
        $ResultadoPed->delete();
        return response()->json(null, 204);
    }

    public function show($id)
    {
        $object = ResultadoPed::find($id);
        return response()->json($object,201);
    }
}
