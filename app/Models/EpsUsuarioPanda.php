<?php

namespace App\Models;

use App\Models\EntidadesTipo\EstadoRegistro;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EpsUsuarioPanda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "eps_usuario_panda";
    protected $primaryKey = "cod_eps_usuarios";
    protected $fillable = [
         "cod_usuario_panda", "cod_administrador_plan_beneficios",
         "estado_eps_usuario", "fecha_ingreso_eps", "fecha_egreso_eps"
    ];




}
//15
