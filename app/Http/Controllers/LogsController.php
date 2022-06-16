<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LogsController extends Controller
{
    public function storeLocal($informacion)
    {
       return Logs::create($informacion);
    }
 
}
