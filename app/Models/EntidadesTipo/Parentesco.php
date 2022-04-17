<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parentesco extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "tipo_parentesco";
    protected $primaryKey = "cod_tipo_parentesco";
    protected $fillable = [
        'nom_tipo_parentesco',
        'value_tipo_parentesco',
        'status_tipo_parentesco'
    ];
}
