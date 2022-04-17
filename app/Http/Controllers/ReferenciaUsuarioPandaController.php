<?php

namespace App\Http\Controllers;

use App\Models\ReferenciaUsuarioPanda;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class ReferenciaUsuarioPandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function storeLocal($referenciaUsuarioPanda)
    {
        $refUsuarioPanda = ReferenciaUsuarioPanda::create($referenciaUsuarioPanda);
        return $refUsuarioPanda;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReferenciaUsuarioPanda  $referenciaUsuarioPanda
     * @return \Illuminate\Http\Response
     */
    public function show(ReferenciaUsuarioPanda $referenciaUsuarioPanda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReferenciaUsuarioPanda  $referenciaUsuarioPanda
     * @return \Illuminate\Http\Response
     */
    public function edit(ReferenciaUsuarioPanda $referenciaUsuarioPanda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReferenciaUsuarioPanda  $referenciaUsuarioPanda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReferenciaUsuarioPanda $referenciaUsuarioPanda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReferenciaUsuarioPanda  $referenciaUsuarioPanda
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReferenciaUsuarioPanda $referenciaUsuarioPanda)
    {
        //
    }
}
