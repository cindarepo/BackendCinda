<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaisDeNacionalidad extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "pais";
    protected $primaryKey = "cod_pais";
    protected $fillable = [
        'nom_pais',
        'value_pais',
        'codigo_iso_pais',
        'status_pais'
    ];

    public function usuariosXpais(){
        return $this->hasMany(PaisDeNacionalidad::class, 'panda_pais_nacimiento',
            'cod_pais');
    }
}
