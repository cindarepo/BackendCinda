<?php

namespace App\Models\EntidadesTipo;

use App\Models\UsuarioPanda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class FondoDePensiones extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "fondo_pension";
    protected $primaryKey = "cod_fondo_pension";
    protected $fillable = [
         "nom_fondo_pension",
        "value_fondo_pension",
        "status_fondo_pension"
    ];


}
