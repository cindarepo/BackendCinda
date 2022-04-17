<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedades extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "propiedades";
    protected $primaryKey = "cod_propiedad";
    protected $fillable = [
        "nom_propiedad",
        "value_propiedad",
        "status_propiedad"
    ];
}
