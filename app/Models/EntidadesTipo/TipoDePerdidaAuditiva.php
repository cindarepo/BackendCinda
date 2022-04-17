<?php

namespace App\Models\EntidadesTipo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDePerdidaAuditiva extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = "tipo_perdida_auditiva";
    protected $primaryKey = "cod_tipo_perdida_auditiva";
    protected $fillable = [
        'nom_tipo_perdida_auditiva',
        'value_tipo_perdida_auditiva',
        'status_tipo_perdida_auditiva'
    ];

    public function tipoPerdida(){
        return $this->belongsTo(TipoDePerdidaAuditiva::class,  'cod_tipo_perdida_auditiva',
            'panda_tipo_perdida');
    }
}
