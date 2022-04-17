<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaDeDiscapacidad extends Model
{

    //    No se esta usando esta tabla
    public $timestamps = false;
    use HasFactory;
    protected $table = "categoriaDeDiscapacidad";
    protected $primaryKey = "cod_categoriaDeDiscapacidad";
    protected $fillable = [
        'cod_categoriaDeDiscapacidad',
        'nom_categoriaDeDiscapacidad',
        'value_categoriaDeDiscapacidad',
        'status_categoriaDeDiscapacidad'
    ];
}
