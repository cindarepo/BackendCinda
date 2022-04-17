<?php

namespace App\Models;

use App\Models\EntidadesTipo\Parentesco;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenciaUsuarioPanda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "referencia_usuario_panda";
    protected $primaryKey = "cod_referencia_usuario_panda";
    protected $fillable = [
        'cod_usuario_panda',
        'cod_informacion_referido',
        'cod_tipo_parentesco'
    ];


    public function parentesco(){
        return $this->hasOne(Parentesco::class, 'cod_tipo_parentesco',
        'cod_tipo_parentesco')->select(['cod_tipo_parentesco', 'nom_tipo_parentesco']);
    }



}
