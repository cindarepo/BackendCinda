<?php

namespace App\Http\Controllers;

use App\Models\EpsUsuarioPanda;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EpsUsuarioPandaController extends Controller
{
    public function storeLocal($informacion)
    {
        return EpsUsuarioPanda::create($informacion);
    }
}
