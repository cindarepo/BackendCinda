<?php

namespace App\Models\EntidadesTipo;

use App\Models\PersonalCinda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPersonal extends Model
{
    //NO POSEE CONTROLADOR
    use HasFactory;
    public $timestamps = false;
    protected $table = "estado_personal";
    protected $primaryKey = "cod_estado_personal";
    protected $fillable = [
        "nom_estado_personal"
    ];

    public function personalEstado(){
        return $this->hasMany(PersonalCinda::class, 'cod_estado_personal',
            'cod_estado_personal');
    }
}
