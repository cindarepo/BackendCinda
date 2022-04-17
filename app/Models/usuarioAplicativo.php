<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class UsuarioAplicativo extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "usuario_aplicativo";
    protected $primaryKey = "cod_usuario_aplicativo";
    protected $fillable = [
        'nombre_usuario',
        'correo_usuario',
        'clave_usuario',
        'fecha_registro',
        'fecha_cambio_clave',
        'fecha_ultimo_ingreso',
        'estado_usuario',
        'codigo_sesion',
        'cod_tipo_usuario'
    ];

}
