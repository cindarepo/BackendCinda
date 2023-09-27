<?php

use App\Http\Controllers\CorreosController;
use App\Http\Controllers\DocumentoUsuarioPandaController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\PED\ActividadPedController;
use App\Http\Controllers\PED\AsignacionProfesionalesController;
use App\Http\Controllers\PED\CantidadSesionesUsuarioController;
use App\Http\Controllers\PED\DescripcionFinalPedController;
use App\Http\Controllers\PED\DescripcionInicioPedController;
use App\Http\Controllers\PED\EvoluvionPedController;
use App\Http\Controllers\PED\ObjetivoPedController;
use App\Http\Controllers\PED\ObjetivosGeneralesPedController;
use App\Http\Controllers\PED\ObjetivoTipoPedController;
use App\Http\Controllers\PED\RecomendacionPedController;
use App\Http\Controllers\PED\RegistroPedController;
use App\Http\Controllers\PersonalCindaController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsuarioFormularioValoracionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TablasTipo\AreasControlador;
use App\Http\Controllers\TablasTipo\CIE_controlador;
use App\Http\Controllers\TablasTipo\DiscapacidadControlador;
use App\Http\Controllers\TablasTipo\DocumentoIdentificacionControlador;
use App\Http\Controllers\TablasTipo\EPSControlador;
use App\Http\Controllers\TablasTipo\ARLControlador;
use App\Http\Controllers\TablasTipo\FondoPensionesControlador;
use App\Http\Controllers\TablasTipo\CajaCompensacionControlador;
use App\Http\Controllers\TablasTipo\EstandarCieControlador;
use App\Http\Controllers\TablasTipo\EtniaControlador;
use App\Http\Controllers\TablasTipo\MunicipioResidenciaControlador;
use App\Http\Controllers\TablasTipo\PaisNacionalidadControlador;
use App\Http\Controllers\TablasTipo\ParentescoControlador;
use App\Http\Controllers\TablasTipo\SexoBiologicoControlador;
use App\Http\Controllers\TablasTipo\TipoAmplificacionOidoControlador;
use App\Http\Controllers\TablasTipo\TipoDiagnosticoControlador;
use App\Http\Controllers\TablasTipo\TipoProcesoControlador;
use App\Http\Controllers\TablasTipo\TipoDocumentoFisicoController;
use App\Http\Controllers\TablasTipo\TablasTipoContenedorController;
use App\Http\Controllers\TablasTipo\TipoGradoPerdidaController;
use App\Http\Controllers\InformacionPersonalPandaController;
use App\Http\Controllers\UsuarioPandaController;
use App\Http\Controllers\EntrevistaController;
use App\Http\Controllers\PropiedadesControlador;
use App\Http\Controllers\ControladorGeneral;
use App\Http\Controllers\OrdenMedicaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('list/CD',[TablasTipoContenedorController::class, 'index']);
Route::get('list/getTablasTipo',[TablasTipoContenedorController::class, 'getTablasTipo']);
Route::get('list/getTablaTipoByNom/{nom}',[TablasTipoContenedorController::class, 'getByNom']);

/**
 * TABLAS TIPO
 */
Route::prefix('propiedades')->group(
    function (){
        Route::get('/',[PropiedadesControlador::class, 'getInfo']);
        Route::post('/new',[PropiedadesControlador::class, 'store']);
        Route::put('/{id}',[PropiedadesControlador::class, 'updateLocal']);
        Route::delete('/{id}',[PropiedadesControlador::class, 'delete']);
    }
);

Route::prefix('area')->group(
    function (){
        Route::get('/',[AreasControlador::class, 'getInfo']);
        Route::post('/new',[AreasControlador::class, 'store']);
        Route::put('/{id}',[AreasControlador::class, 'update']);
    }
);

Route::prefix('estandar_cie')->group(
    function (){
        Route::get('/',[EstandarCieControlador::class, 'getInfo']);
        Route::post('/new',[EstandarCieControlador::class, 'store']);
        Route::put('/{id}',[EstandarCieControlador::class, 'update']);
    }
);

Route::prefix('tipo_diagnostico')->group(
    function (){
        Route::get('/',[TipoDiagnosticoControlador::class, 'getInfo']);
        Route::post('/new',[TipoDiagnosticoControlador::class, 'store']);
        Route::put('/{id}',[TipoDiagnosticoControlador::class, 'update']);
    }
);



Route::prefix('discapacidad')->group(
    function (){
        Route::get('/',[DiscapacidadControlador::class, 'getInfo']);
        Route::post('/new',[DiscapacidadControlador::class, 'store']);
        Route::put('/{id}',[DiscapacidadControlador::class, 'update']);
    }
);


Route::prefix('tipo_documento_identificacion')->group(
    function (){
        Route::get('/',[DocumentoIdentificacionControlador::class, 'getInfo']);
        Route::post('/new',[DocumentoIdentificacionControlador::class, 'store']);
        Route::put('/{id}',[DocumentoIdentificacionControlador::class, 'update']);
    }
);

Route::prefix('administrador_plan_beneficios')->group(
    function (){
        Route::get('/',[EPSControlador::class, 'getInfo']);
        Route::post('/new',[EPSControlador::class, 'store']);
        Route::put('/{id}',[EPSControlador::class, 'update']);
    }
);

Route::prefix('administradora_riesgos_laborales')->group(
    function (){
        Route::get('/',[ARLControlador::class, 'getInfo']);
        Route::post('/new',[ARLControlador::class, 'store']);
        Route::put('/{id}',[ARLControlador::class, 'update']);
    }
);

Route::prefix('fondo_de_pension')->group(
    function (){
        Route::get('/',[FondoPensionesControlador::class, 'getInfo']);
        Route::post('/new',[FondoPensionesControlador::class, 'store']);
        Route::put('/{id}',[FondoPensionesControlador::class, 'update']);
    }
);

Route::prefix('caja_compensacion')->group(
    function (){
        Route::get('/',[CajaCompensacionControlador::class, 'getInfo']);
        Route::post('/new',[CajaCompensacionControlador::class, 'store']);
        Route::put('/{id}',[CajaCompensacionControlador::class, 'update']);
    }
);

Route::prefix('PertenenciaDeEtnia')->group(
    function (){
        Route::get('/',[EtniaControlador::class, 'getInfo']);
        Route::post('/new',[EtniaControlador::class, 'store']);
        Route::put('/{id}',[EtniaControlador::class, 'update']);
    }
);

Route::prefix('municipio_divipola')->group(
    function (){
        Route::get('/',[MunicipioResidenciaControlador::class, 'getInfo']);
        Route::post('/new',[MunicipioResidenciaControlador::class, 'store']);
        Route::put('/{id}',[MunicipioResidenciaControlador::class, 'update']);
    }
);


Route::prefix('pais')->group(
    function (){
        Route::get('/',[PaisNacionalidadControlador::class, 'getInfo']);
        Route::post('/new',[PaisNacionalidadControlador::class, 'store']);
        Route::put('/{id}',[PaisNacionalidadControlador::class, 'update']);
    }
);


Route::prefix('tipo_parentesco')->group(
    function (){
        Route::get('/',[ParentescoControlador::class, 'getInfo']);
        Route::post('/new',[ParentescoControlador::class, 'store']);
        Route::put('/{id}',[ParentescoControlador::class, 'update']);
    }
);



Route::prefix('sexo_biologico')->group(
    function (){
        Route::get('/',[SexoBiologicoControlador::class, 'getInfo']);
        Route::post('/new',[SexoBiologicoControlador::class, 'store']);
        Route::put('/{id}',[SexoBiologicoControlador::class, 'update']);
    }
);

Route::prefix('tipo_proceso')->group(
    function (){
        Route::get('/',[TipoProcesoControlador::class, 'getInfo']);
        Route::post('/new',[TipoProcesoControlador::class, 'store']);
        Route::put('/{id}',[TipoProcesoControlador::class, 'update']);
    }
);

Route::prefix('cie_estandar')->group(
    function (){
        Route::get('/e/{id}',[CIE_controlador::class, 'getInfo']);
        Route::post('/new',[CIE_controlador::class, 'store']);
        Route::put('/{id}',[CIE_controlador::class, 'update']);
    }
);

Route::prefix('tipo_amplificacion')->group(
    function (){
        Route::get('/',[TipoAmplificacionOidoControlador::class, 'getInfo']);
        Route::post('/new',[TipoAmplificacionOidoControlador::class, 'store']);
        Route::put('/{id}',[TipoAmplificacionOidoControlador::class, 'update']);
        Route::put('/{id}',[TipoAmplificacionOidoControlador::class, 'show']);
    }
);

Route::prefix('tipo_documento_fisico')->group(
    function (){
        Route::get('/',[TipoDocumentoFisicoController::class, 'index']);
        Route::post('/new',[TipoDocumentoFisicoController::class, 'store']);
        Route::put('/{id}',[TipoDocumentoFisicoController::class, 'update']);
    }
);


Route::prefix('tipo_perdida_auditiva')->group(
    function (){
        Route::get('/',[TipoGradoPerdidaController::class, 'index']);
        Route::post('/new',[TipoGradoPerdidaController::class, 'store']);
        Route::put('/{id}',[TipoGradoPerdidaController::class, 'update']);
        Route::get('/{id}',[TipoGradoPerdidaController::class, 'show']);
    }
);

Route::prefix('actividad_ped')->group(
    function (){
        Route::get('/',[ActividadPedController::class, 'getInfo']);
        Route::post('/new',[ActividadPedController::class, 'store']);
        Route::put('/{id}',[ActividadPedController::class, 'update']);
        Route::get('/{id}',[ActividadPedController::class, 'show']);
    }
);

Route::prefix('objetivo_general')->group(
    function (){
        Route::get('/',[ObjetivosGeneralesPedController::class, 'getInfo']);
        Route::post('/new',[ObjetivosGeneralesPedController::class, 'store']);
        Route::put('/{id}',[ObjetivosGeneralesPedController::class, 'update']);
        Route::get('/{id}',[ObjetivosGeneralesPedController::class, 'show']);
    }
);

Route::prefix('objetivo_tipo')->group(
    function (){
        Route::get('/',[ObjetivoTipoPedController::class, 'getInfo']);
        Route::post('/new',[ObjetivoTipoPedController::class, 'store']);
        Route::put('/{id}',[ObjetivoTipoPedController::class, 'update']);
        Route::get('/{id}',[ObjetivoTipoPedController::class, 'show']);
    }
);


Route::prefix('recomendacion_ped')->group(
    function (){
        Route::get('/',[RecomendacionPedController::class, 'getInfo']);
        Route::post('/new',[RecomendacionPedController::class, 'store']);
        Route::put('/{id}',[RecomendacionPedController::class, 'update']);
        Route::get('/{id}',[RecomendacionPedController::class, 'show']);
    }
);

Route::prefix('objetivo_ped')->group(
    function (){
        Route::get('/',[ObjetivoPedController::class, 'getInfo']);
        Route::post('/new',[ObjetivoPedController::class, 'store']);
        Route::put('/{id}',[ObjetivoPedController::class, 'update']);
        Route::get('/{id}',[ObjetivoPedController::class, 'show']);
    }
);





/**
 *FIN TABLAS TIPO
 */

Route::prefix('informacion_personal_panda')->group(
    function (){
        Route::get('/',[InformacionPersonalPandaController::class, 'index']);
        Route::post('/new',[InformacionPersonalPandaController::class, 'store']);
        Route::put('/{id}',[InformacionPersonalPandaController::class, 'update']);
    }
);


Route::prefix('usuario_panda')->group(
    function (){
        Route::get('/{id}',[UsuarioPandaController::class, 'getInfo']);
        Route::get('/u/{id}',[UsuarioPandaController::class, 'getInfoUsuarioxcod']);

        // Orden medica
        Route::get('/orden',[UsuarioPandaController::class, 'getOrdenMedica']);
        Route::post('/agregarOrdenMedica',[OrdenMedicaController::class, 'store']);
        Route::get('/estados/all', [UsuarioPandaController::class, 'getStatusUsuarioPanda']);

        Route::post('/update',[ControladorGeneral::class, 'editUsuarioPanda']);
        Route::get('/d/{id}',[UsuarioPandaController::class, 'getDiagnostico']);
        Route::post('/new',[ControladorGeneral::class, 'storeUsuarioPanda']);
        Route::post('/u/{id}/{cod}',[UsuarioPandaController::class, 'cambiarEstadoUsuarioPanda']);
        Route::post('/asignacion',[ControladorGeneral::class, 'updateAsignacion']);
        Route::post('/asignacion/{id}',[UsuarioPandaController::class, 'getAsignacionPaciente']);
        Route::get('/l/{id}',[CantidadSesionesUsuarioController::class, 'getSesionesAnterior']);
        Route::get('/asignacion/{id}',[AsignacionProfesionalesController::class, 'getAsignacionByNinoPanda']);


    }
);


Route::prefix('entrevista_panda')->group(
    function (){
        Route::get('/u/{id}',[UsuarioPandaController::class, 'getEntrevista']);
        Route::post('/new',[ControladorGeneral::class, 'storeEntrevista']);
        Route::put('/{id}',[EntrevistaController::class, 'update']);
    }
);





Route::prefix('mail')->group(
    function (){
        Route::post('/send',[CorreosController::class, 'sendMail']);
        Route::post('/welcome',[CorreosController::class, 'sendMailBienvenida']);
    }
);








Route::prefix('asignacion_profesionales')->group(
    function (){
        // Get all patients for professional and area (list)
        Route::get('/{idProfesional}',[AsignacionProfesionalesController::class, 'getInfoUsuariosxProfesional']);
        // Get assigned patients for professional
        Route::get('/a/{id}',[AsignacionProfesionalesController::class, 'getAsignacion']);
    });

Route::prefix('doc')->group(
    function (){
        Route::get('/{id}',[DocumentoUsuarioPandaController::class, 'getDocumentos']);
        Route::post('/new',[ControladorGeneral::class, 'storeDocumentos']);
    });

Route::prefix('login/forget')->group(
    function (){
        Route::post('/sendMail',[CorreosController::class, 'sendMail']);
        Route::post('/verifyCode',[ControladorGeneral::class, 'verificarCodigo']);
        Route::post('/reset',[ControladorGeneral::class, 'cambiarClave']);
    });

Route::prefix('login/new')->group(
    function (){
        Route::post('/sendNew',[CorreosController::class, 'sendMailBienvenida1']);

    });



Route::prefix('profesionales')->group(
    function (){
        Route::get('/',[ProfesionalController::class, 'getInfo']);
        Route::get('/a/{id}',[ProfesionalController::class, 'getInfoxcodArea']);
        Route::post('/new',[ControladorGeneral::class, 'storeFuncionario']);
        Route::get('/{id}',[ProfesionalController::class, 'getInfoxcod']);
        Route::post('/update',[ControladorGeneral::class, 'editFuncionario' ]);
        Route::get('/l/{id}',[PersonalCindaController::class, 'getProfesionalxcodUser']);

        Route::get('/e/{idFuncionario}/{cod_status}',[PersonalCindaController::class, 'cambiarEstadoFuncionario']);


    });

Route::prefix('evolucion_ped')->group(
    function (){
        Route::get('/u/{id}',[EvoluvionPedController::class, 'serviceGetInfoxcodusuario']);
        Route::get('/e/{idEvolucion}',[EvoluvionPedController::class, 'serviceGetInfoxevolucion']);
        Route::post('/new',[ControladorGeneral::class, 'storeEvolucionPED']);
        Route::post('/edit',[ControladorGeneral::class, 'editarEvolucionPED']);

    });

Route::prefix('registro_ped')->group(
    function (){
        Route::get('/ped/{cod_ped}',[RegistroPedController::class, 'getSesionPed']);
        Route::get('/e/{evolucion}/{estado}',[RegistroPedController::class, 'getInfoxcodEvolucion']);
        Route::get('/a/{cod_usuario}/{area}',[RegistroPedController::class, 'getPedAcumuladosxCodUsuarioxArea']);

        Route::get('/acumulada/{id}',[ControladorGeneral::class, 'pasarAcumulada']);

        // Guarda acumuladas y no acumuladas
        Route::post('/new',[ControladorGeneral::class, 'storeRegistroPed']);

        // Carga una acumulada en la evolución
        Route::post('/newA',[ControladorGeneral::class, 'storeRegistroPedAcumulado']);


        Route::get('/inicio',[DescripcionInicioPedController::class, 'getInfo']);
        Route::get('/final',[DescripcionFinalPedController::class, 'getInfo']);


        Route::get('/act/{id}',[ActividadPedController::class, 'getActividadXobjetivoGeneral']);

        Route::get('/OT/{id}',[ObjetivoTipoPedController::class, 'getObjetivoTipo_area']);
        Route::get('/horarios',[ObjetivoTipoPedController::class, 'getHorarios']);
        Route::get('/recomendacion',[RecomendacionPedController::class, 'getRecomendacionXarea']);
        Route::get('/resultado',[ObjetivoTipoPedController::class, 'getResultadoXarea']);

        Route::get('/OG/{id}',[ObjetivosGeneralesPedController::class, 'getObjetivoPed_objetivo_tipo']);

        Route::get('/OP/{id}',[ObjetivoPedController::class, 'getObjetivoPed_objetivoGeneral']);

    });


Route::prefix('sesion')->group(
    function (){
        Route::post('/login',[UserController::class, 'authenticate']);
        Route::post('/me',[UserController::class, 'me']);
        Route::post('/logout',[UserController::class, 'logout']);

    });

Route::prefix('informes')->group(
    function (){
        Route::get('/acta/{id}/{evolucion}',[InformesController::class, 'exportarActa']);
        Route::get('/ped/{id}/{evolucion}/{area}',[InformesController::class, 'exportarPed']);
        Route::get('/pf/{id}/{evolucion}/',[InformesController::class, 'exportarPlanillaFirmas']);
        Route::get('/entrevista/{id}',[InformesController::class, 'exportarEntrevista']);
        Route::get('/showpf/{id}/{evolucion}/{descarga}',[InformesController::class, 'mostrarPlanillaFirmar']);


    });


Route::prefix('valoraciones')->group(
    function (){
        Route::post('/store',[ControladorGeneral::class, 'storeValoraciones']);
        Route::get('/v/{idusuario}/{tipodiagnostico}/{tipoFormulario}',[UsuarioFormularioValoracionController::class, 'getRtaValoracion']);
    });

Route::prefix('diagnostico')->group(
    function (){
        Route::post('/update',[ControladorGeneral::class, 'updateDiagnosticos']);
        Route::get('/{idusuario}',[UsuarioPandaController::class, 'getDiagnostico']);
    });

/*Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('user','App\Http\Controllers\UserController@getAuthenticatedUser');

    Route::prefix('profesionales')->group(
        function (){
            Route::get('/',[ProfesionalController::class, 'getInfo']);
            Route::post('/new',[ControladorGeneral::class, 'storeFuncionario']);
            Route::get('/{id}',[ProfesionalController::class, 'getInfoxcod']);
            Route::post('/new_1',[ControladorGeneral::class, 'prueba']);
        });

});*/
