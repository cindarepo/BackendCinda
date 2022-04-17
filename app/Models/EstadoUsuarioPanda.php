<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoUsuarioPanda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "status_usuario_panda";
    protected $primaryKey = "cod_status_usuario_panda";
    protected $fillable = [
        'nom_status_usuario_panda',
        'status_status_usuario_panda'
    ];


    public function usuarioEstado(){
        return $this->hasMany(UsuarioPanda::class, 'panda_cod_status_usuario',
            'cod_status_usuario_panda');
    }
}
