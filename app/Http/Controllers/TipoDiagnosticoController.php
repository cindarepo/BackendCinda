<?php

namespace App\Http\Controllers;

use App\Models\TipoDiagnostico;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class TipoDiagnosticoController extends Controller
{
    public function storeLocal($informacion)
    {
       return TipoDiagnostico::create($informacion);
    }
}
