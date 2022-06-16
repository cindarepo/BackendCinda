<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "logs_errores";
    protected $primaryKey = "cod_log";
    protected $fillable = [
    "cod_usuario",
    "detalle_funcion",
    "detalle_tabla",
    "string_log",
    ];
}
