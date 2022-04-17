<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "area";
    protected $primaryKey = "cod_area";
    protected $fillable = [
        'cod_area',
        'nom_area',
        'value_area',
        'status_area'
    ];
}
