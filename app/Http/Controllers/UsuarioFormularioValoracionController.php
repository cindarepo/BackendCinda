<?php

namespace App\Http\Controllers;

use App\Models\UsuarioFormularioValoracion;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class UsuarioFormularioValoracionController extends Controller
{
    public function storeLocal( $infoUsuario)
    {
        $usuario = UsuarioFormularioValoracion::create($infoUsuario);
        return $usuario;
    }

    public function updateLocal($infoUsuario, $id)
    {
        return UsuarioFormularioValoracion::find($id)->update($infoUsuario);
    }

    public function getRtaValoracion($idusuario, $tipodiagnostico, $tipoformulario){
        $respuestaForm =  DB::select('select * from respuesta_informacion_formularios where cod_usuario_formulario_valoracion=(
                                            select cod_usuario_formulario_valoracion from usuario_formulario_valoracion where cod_usuario_panda = ?
                                            and cod_tipo_formulario_valoracion=? order by cod_usuario_formulario_valoracion)', [$idusuario, $tipoformulario]);

        $ciePaciente =  DB::select('select * from cie where cod_usuario_panda = ? and
                                    cod_tipo_diagnostico = ?', [$idusuario, $tipodiagnostico]);

        $cifPaciente = DB::select('select  diagnostico_cif_usuario.cod_usuario_panda, diagnostico_cif_usuario.detalle_cif_usuario
                                    from  diagnostico_cif_usuario
                                    where diagnostico_cif_usuario.cod_usuario_panda = ? and
                                          diagnostico_cif_usuario.cod_tipo_diagnostico = ?', [$idusuario, $tipodiagnostico]);


        return response()->json([
            'Respuestas' => $respuestaForm ,
            'CIE' => $ciePaciente,
            'CIF' => $cifPaciente
        ], 200);

    }

}
