<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaGeneralFormulario extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "categoria_general_formulario";
    protected $primaryKey = "cod_categoria_general_formulario";
    protected $fillable = [
        'nom_categoria_general_formulario',
    ];
}
