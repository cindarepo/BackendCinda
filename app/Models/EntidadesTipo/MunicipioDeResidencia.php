<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunicipioDeResidencia extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "municipio_divipola";
    protected $primaryKey = "cod_municipio_divipola";
    protected $fillable = [
        'nom_municipio_divipola',
        'value_municipio_divipola',
        'codigo_divipola',
        'status_municipio_divipola'
    ];
}
