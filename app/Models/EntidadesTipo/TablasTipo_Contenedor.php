<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablasTipo_Contenedor extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "tablas_tipo";
    protected $primaryKey = "cod_tabla_tipo";
    protected $fillable = [
        "nom_tabla_tipo",
        "nombre_mostrar_tabla_tipo",
        "mostrar_columnas_tablas_tipo"
    ];
}
