<?php

namespace App\Models\EntidadesTipo;
use App\Models\InformacionPersonalPanda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SexoBiologico extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "sexo_biologico";
    protected $primaryKey = "cod_sexo_biologico";
    protected $fillable = [
        'nom_sexo_biologico',
        'value_sexo_biologico',
        'status_sexo_biologico'
    ];

    public function informacionPanda(){
        //cambia a return $this->belongsTo(InformacionPersonalPanda::class, 'cod_sexo_biologico',
        //        'panda_sexo_biologico');
        return $this->hasMany(InformacionPersonalPanda::class, 'panda_sexo_biologico',
            'cod_sexo_biologico');
    }

}
