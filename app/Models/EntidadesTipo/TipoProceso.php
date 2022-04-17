<?php

namespace App\Models\EntidadesTipo;

use App\Models\UsuarioPanda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProceso extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "tipo_proceso";
    protected $primaryKey = "cod_tipo_proceso";
    protected $fillable = [
        'nom_tipo_proceso',
        'value_tipo_proceso',
        'status_tipo_proceso'
    ];


    public function tipo_proceso_usuario(){
        return $this->belongsTo(UsuarioPanda::class, 'cod_tipo_proceso',
            'panda_tipo_proceso');
    }
}
