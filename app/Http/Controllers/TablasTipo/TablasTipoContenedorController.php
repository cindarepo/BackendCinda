<?php

namespace App\Http\Controllers\TablasTipo;

use Illuminate\Routing\Controller;
use App\Models\EntidadesTipo\TablasTipo_Contenedor;
use Illuminate\Http\Request;

class TablasTipoContenedorController extends Controller
{

    public function index()
    {
        $data = TablasTipo_Contenedor::All();
        return response()->json($data, 201);
    }

    public function getByNom($nom)
    {
        $data = TablasTipo_Contenedor::where('nom_Tabla_tipo', '=', $nom)->firstOrFail();

        $response = [
            'data' => $data,
            'success' => true,
            'code' => 200,
            'message' => 'Consulta exitosa'
        ];

        return $response;
    }

    public function getTablasTipo()
    {
        $page = request('page');
        $sort = request('sort');
        $limit = request('limit');
        $desc = request('desc') === 'true' ? true : false;;

        $all = TablasTipo_Contenedor::all();
        $data = $all->sortBy($sort, SORT_REGULAR, $desc)->forPage($page, $limit)->values();

        $response = [
            'data' => $data,
            'success' => true,
            'code' => 200,
            'message' => 'Consulta exitosa',
            'pagination' => ['page' => $page, 'sort' => $sort, 'limit' => $limit, 'desc' => $desc, 'count' => $all->count()]
        ];

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\TablasTipo_Contenedor $tablasTipo_Contenedor
     * @return \Illuminate\Http\Response
     */
    public function show(TablasTipo_Contenedor $tablasTipo_Contenedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TablasTipo_Contenedor $tablasTipo_Contenedor
     * @return \Illuminate\Http\Response
     */
    public function edit(TablasTipo_Contenedor $tablasTipo_Contenedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TablasTipo_Contenedor $tablasTipo_Contenedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TablasTipo_Contenedor $tablasTipo_Contenedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TablasTipo_Contenedor $tablasTipo_Contenedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(TablasTipo_Contenedor $tablasTipo_Contenedor)
    {
        //
    }
}
