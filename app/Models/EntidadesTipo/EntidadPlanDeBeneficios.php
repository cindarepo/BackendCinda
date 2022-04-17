<?php

namespace App\Models\EntidadesTipo;

use App\Models\EpsUsuarioPanda;
use App\Models\UsuarioPanda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadPlanDeBeneficios extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "administrador_plan_beneficios";
    protected $primaryKey = "cod_administrador_plan_beneficios";
    protected $fillable = [
        'nom_administrador_plan_beneficios',
        'value_administrador_plan_beneficios',
        'cod_sgsss',
        'status_administrador_plan_beneficios'
    ];

    public function relacionEpsUsuario(){
        return  $this->hasMany(EpsUsuarioPanda::class, 'cod_administrador_plan_beneficios',
            'cod_administrador_plan_beneficios');
    }
}
