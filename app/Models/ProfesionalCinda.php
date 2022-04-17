<?php

namespace App\Models;

use App\Models\EntidadesTipo\Area;
use App\Models\EntidadesTipo\EntidadPlanDeBeneficios;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesionalCinda extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "profesional_cinda";
    protected $primaryKey = "cod_profesional_cinda";
    protected $fillable = [
        "cod_personal_cinda",
        "cod_area"
    ];

    public function cod_personal_cinda(){
        return $this->hasOne(PersonalCinda::class,
            'cod_personal_cinda',
            'cod_personal_cinda');
    }

    public function cod_area(){
        return $this->hasOne(Area::class,
            'cod_area',
            'cod_area');
    }






}
