<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PED\AsignacionProfesionalesController;
use App\Http\Controllers\PED\CantidadSesionesUsuarioController;
use App\Http\Controllers\PED\EvoluvionPedController;
use App\Http\Controllers\PED\RegistroPedController;
use App\Models\InformacionComplementariaEmpleado;
use App\Models\InformacionPersonalEmpleado;
use App\Models\ProfesionalCinda;
use App\Models\PersonalCinda;
use App\Models\InformacionVivienda;
use App\Models\UsuarioPanda;
use DateTimeZone;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;
use function Illuminate\Events\queueable;


class ControladorGeneral extends Controller
{


    private $viviendacontroller;
    private $informacionPandaController;
    private $pandaUsuarioController;
    private $referenciaPandaController;
    private $informacionreferidoController;
    private $entrevistaController;
    private $informacionPersonalEmpleadoController;
    private $informacionComplementariaEmpleadoController;
    private $profesionalCindaController;
    private $personalCindaController;
    private $epsUsuarioPandaController;
    private $diagnosticoCieController;
    private $diagnosticoCifController;
    private $cirugiasUsuarioController;
    private $asignacionProfesionalesController;
    private $registroPedController;
    private $cantidad_sesiones_ped;
    private $evolucion_mensual_ped;
    private $usuarioAplicativoController;
    private $usuarioFormularioValoracionController;
    private $RespuestaInformacionFormularioController;
    private $DocumentosPandaController;
    private $correoController;

    function __construct()
    {
        $this->viviendacontroller = new InformacionViviendaController();
        $this->informacionPandaController = new InformacionPersonalPandaController();
        $this->pandaUsuarioController = new UsuarioPandaController();
        $this->referenciaPandaController = new ReferenciaUsuarioPandaController();
        $this->informacionreferidoController = new InformacionReferidoController();
        $this->entrevistaController = new EntrevistaController();
        $this->informacionComplementariaEmpleadoController = new InformacionComplementariaEmpleadoController();
        $this->informacionPersonalEmpleadoController = new InformacionPersonalEmpleadoController();
        $this->profesionalCindaController = new ProfesionalController();
        $this->personalCindaController = new PersonalCindaController();
        $this->epsUsuarioPandaController = new EpsUsuarioPandaController();
        $this->diagnosticoCieController = new DiagnosticoCieUsuarioController();
        $this->diagnosticoCifController = new DiagnosticoCifUsuarioController();
        $this->cirugiasUsuarioController = new CirugiasUsuarioPandaController();
        $this->registroPedController = new RegistroPedController();
        $this->cantidad_sesiones_ped = new CantidadSesionesUsuarioController();
        $this->evolucion_mensual_ped = new EvoluvionPedController();
        $this->userController = new UserController();
        $this->usuarioFormularioValoracionController = new UsuarioFormularioValoracionController();
        $this->RespuestaInformacionFormularioController = new RespuestaInformacionFormulariosController();
        $this->DocumentosPandaController = new DocumentoUsuarioPandaController();
        $this->asignacionProfesionalesController = new AsignacionProfesionalesController();
        $this->correoController = new CorreosController();

    }


    public function storeUsuarioPanda(Request $request)
    {
        $datosGenerales = $request->json()->all();
        /**
         * Datos de Vivienda del usuario
         */
        $dataVivienda = $datosGenerales['panda_informacion_personal']['panda_informacion_vivienda'];

        try {

            $idVivienda = $this->viviendacontroller->storeLocal($dataVivienda)->cod_informacion_vivienda;
            /**
             * Datos de la información basica del usuario Panda
             */
            $dataPanda = $datosGenerales['panda_informacion_personal'];
            $dataPanda['panda_informacion_vivienda'] = $idVivienda;
            $idPandaInformacionPersonal = $this->informacionPandaController->storeLocal($dataPanda)->cod_informacion_personal_panda;
            /**
             *Agregar la información del usuario panda
             * Devuelve el codigo del usuario panda
             */
            $datosUsuarioPanda = $datosGenerales['panda_informacion_personal'];
            $datosUsuarioPanda["panda_informacion_personal"] = $idPandaInformacionPersonal;
            $datosUsuarioPanda["panda_cod_status_usuario"] = 1;

            /**
             *
             * MODIFICAR AL OTRO LADO
             *
             */
            $date = new DateTime("now", new DateTimeZone('America/Bogota'));
            $datosUsuarioPanda["panda_fecha_ingreso_usuario"] = $date;
            $idUsuarioPanda = $this->pandaUsuarioController->storeLocal($datosUsuarioPanda)->cod_usuario_panda;

            /**
             * CREAR FILA DE ASIGNACION DE PROFESIONALES
             */

            $asignacion = array();
            $asignacion['cod_nino_panda'] = $idUsuarioPanda;
            $this->asignacionProfesionalesController->createlocal($asignacion);


            /**
             * Agregar informacion a tabla de eps n-n
             */
            $epsusuario = array();
            $epsusuario['cod_usuario_panda'] = $idUsuarioPanda;
            $epsusuario['cod_administrador_plan_beneficios'] = $datosGenerales['panda_plan_beneficios'];
            $epsusuario['estado_eps_usuario'] = 1;
            $idEpsUsuarioPanda = $this->epsUsuarioPandaController->storeLocal($epsusuario);
            /**
             * Agregar la información de los referidos  (General)
             */
            $referidos = $datosGenerales['referencias'];
            foreach ($referidos as $referido) {
                $dataViviendaR = $referido['vivienda_referido'];
                $idViviendaR = $this->viviendacontroller->storeLocal($dataViviendaR)->cod_informacion_vivienda;
                $datosReferido = $referido['informacion_referido'];
                $datosReferido['referido_informacion_vivienda'] = $idViviendaR;
                $idReferido = $this->informacionreferidoController->storeLocal($datosReferido)->cod_informacion_referido;
                $usuarioPandaReferencia = array();
                $usuarioPandaReferencia['cod_usuario_panda'] = $idUsuarioPanda;
                $usuarioPandaReferencia['cod_informacion_referido'] = $idReferido;
                $usuarioPandaReferencia['cod_tipo_parentesco'] = $datosReferido['cod_tipo_parentesco'];
                $idReferenciaUsuario = $this->referenciaPandaController->storeLocal($usuarioPandaReferencia)->cod_referencia_usuario_panda;
            }
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], 200);
        }
        return response()->json([
            'message' => '¡Se registro exitosamente!',
            'success' => true
        ], 200);
    }

    public function editUsuarioPanda(Request $request)
    {
       try {
            $datosGenerales = $request->json()->all();
            $id_usuario = $datosGenerales['cod_usuario_panda'];
            /**
             * INFORMACION DE LA VIVIENDA
             */
            $dataViviendaID = $datosGenerales['panda_informacion_vivienda']['cod_informacion_vivienda'];
            $dataVivienda = $datosGenerales['panda_informacion_vivienda'];
            $idVivienda = $this->viviendacontroller->updateLocal($dataVivienda, $dataViviendaID);
            /**
             * Datos de la información basica del usuario Panda
             */
            $dataPanda = $datosGenerales['panda_informacion_personal'];
            $idPanda = $datosGenerales['panda_informacion_personal']['cod_informacion_personal_panda'];
            $idPandaInformacionPersonal = $this->informacionPandaController->updateLocal($dataPanda, $idPanda);

            /**
             * Recorrido del arreglo de referencias
             */
            $referencias = $datosGenerales['referencias'];
            foreach ($referencias as $fila) {
                $cod = $fila['cod_informacion_referido'];
                $datosReferido = $fila['informacion_referido'];
                $this->informacionreferidoController->updateLocal($datosReferido, $cod);

                $idViviendaReferido = $fila['vivienda_referido']['cod_informacion_vivienda'];
                $dataVivienda = $fila['vivienda_referido'];
                $this->viviendacontroller->updateLocal($dataVivienda, $idViviendaReferido);

            }

            $eps = $datosGenerales['panda_plan_beneficios'];
            $consulta = $this->epsUsuarioPandaController->buscarEps($id_usuario);
            $codAdmi = $consulta[0]->cod_administrador_plan_beneficios;
            $codEps = $consulta[0]->cod_eps_usuarios;
            if($eps != $codAdmi){
                $epsNueva = array();
                $epsNueva['cod_usuario_panda'] = $id_usuario;
                $epsNueva['cod_administrador_plan_beneficios'] = $eps;
                $date = new DateTime("now", new DateTimeZone('America/Bogota'));
                $epsNueva['fecha_ingreso_eps'] = $date;
                $epsNueva[ 'estado_eps_usuario'] = 1;
                $this->epsUsuarioPandaController->storeLocal($epsNueva);
                $epsAnterior = array();
                $epsAnterior['fecha_egreso_eps'] = $date;
                $epsAnterior['estado_eps_usuario'] = 2;
                $this->epsUsuarioPandaController->updateLocal($epsAnterior, $codEps);
            }

        }catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false], 200);
        }

        return response()->json([
            'message' => '¡Se actualizo exitosamente!',
            'success' => true
        ], 201);

    }

    public function storeEntrevista(Request $request)
    {

        try {

            $datosGenerales = $request->json()->all();
            $id_usuario = $datosGenerales['id'];
            /**
             * UPDATE usuario_panda
             */
            $datosGeneralesPanda = array();
            $datosGeneralesPanda['panda_tipo_proceso'] = $datosGenerales['usuario_panda']['panda_tipo_proceso'];
            $datosGeneralesPanda['panda_amplificacion_derecha'] = $datosGenerales['usuario_panda']['panda_amplificacion_derecha'];
            $datosGeneralesPanda['panda_amplificacion_izquierdo'] = $datosGenerales['usuario_panda']['panda_amplificacion_izquierdo'];
            $datosGeneralesPanda['panda_edad_auditiva'] = $datosGenerales['usuario_panda']['panda_edad_auditiva'];

            $this->pandaUsuarioController->cambiarEstadoUsuarioPanda($id_usuario, 2);

            $this->pandaUsuarioController->updateLocal($datosGeneralesPanda, $id_usuario);
            /**
             * Diagnostico CIE
             */
            $datosDiagnostico = $datosGenerales['diagnostico_cie'];
            $datosDiagnostico['cod_usuario_panda'] = $id_usuario;
            $this->diagnosticoCieController->storeLocal($datosDiagnostico);

            /**
             * Cirugias panda
             */
            $cirugia = $datosGenerales['cirugias_panda'];
            foreach ($cirugia as $c) {
                $datosCirugia = $c;
                $datosCirugia['cod_usuario_panda'] = $id_usuario;
                $this->cirugiasUsuarioController->storeLocal($datosCirugia);
            }

            /**
             * Entrevista
             */
            $datosEntrevista = $datosGenerales['entrevista'];
            $date = new DateTime("now", new DateTimeZone('America/Bogota'));
            $datosEntrevista['entrevista_panda_fecha'] =$date;
            $datosEntrevista['entrevista_panda_entrevistador'] = $id_usuario;
            $this->entrevistaController->storelocal($datosEntrevista);

        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false], 200);
        }
        return response()->json([
            'message' => '¡Se registro exitosamente!',
            'success' => true
        ], 200);


    }

    public function EditEntrevista(Request $request)
    {

        try {
            $datosGenerales = $request->json()->all();
            $id_usuario = $datosGenerales['id'];
            /**
             * UPDATE usuario_panda
             */
            $datosGeneralesPanda = array();
            //$datosGeneralesPanda['panda_plan_beneficios'] = $datosGenerales['usuario_panda']['panda_plan_beneficios'];
            $datosGeneralesPanda['panda_tipo_proceso'] = $datosGenerales['usuario_panda']['panda_tipo_proceso'];
            $datosGeneralesPanda['panda_amplificacion_derecha'] = $datosGenerales['usuario_panda']['panda_amplificacion_derecha'];
            $datosGeneralesPanda['panda_amplificacion_izquierdo'] = $datosGenerales['usuario_panda']['panda_amplificacion_izquierdo'];
            $datosGeneralesPanda['panda_edad_auditiva'] = $datosGenerales['usuario_panda']['panda_edad_auditiva'];
            $this->pandaUsuarioController->updateLocal($datosGeneralesPanda, $id_usuario);
            /**
             * Diagnostico CIE
             */
            $datosDiagnostico = $datosGenerales['diagnostico_cie'];
            $codDiagnosticoCIE = $datosDiagnostico['cod_diagnostico_cie'];
            $this->diagnosticoCieController->updateLocal($datosDiagnostico, $codDiagnosticoCIE);
            /**
             * Cirugias panda
             */
            $datosCirugia = $datosGenerales['cirugias_panda'];
            $codCirugia = $datosCirugia['cirugias_usuario_panda'];
            $this->cirugiasUsuarioController->updateLocal($datosCirugia, $codCirugia);
            /**
             * Entrevista
             */
            $datosEntrevista = $datosGenerales['entrevista'];
            $idEntrevista = $datosEntrevista['cod_entrevista'];
            $this->entrevistaController->updateLocal($datosEntrevista, $idEntrevista);

        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Sucedio un error!',
                'success' => false], 200);
        }
        return response()->json([
            'message' => '¡Se registro exitosamente!',
            'success' => true
        ], 200);

    }

    public function prueba(Request $request)
    {
        $datosGenerales = $request->json()->all();
        $dataProfesional = array();
        $dataProfesional['email'] = $datosGenerales['informacion_personal']['empleado_correo_electronico'];
        $dataProfesional['name'] = $datosGenerales['informacion_personal']['empleado_correo_electronico'];
        $dataProfesional['password'] = Hash::make($datosGenerales['informacion_personal']['empleado_documento_id']);
        $dataProfesional['fecha_registro'] = now();
        $dataProfesional['fecha_cambio_clave'] = now();
        $dataProfesional['fecha_ultimo_ingreso'] = now();
        $dataProfesional['estado_usuario'] = 1;
        $dataProfesional['codigo_sesion'] = 1000;

        /**
         * 1. Superadministrador
         * 2. Coordinador
         * 3. Profesionales
         * 4. Administrativo
         * 5. Auditor
         */
        $dataProfesional['cod_tipo_usuario'] = 3;
        $arreglo = $this->userController->localregister($dataProfesional);
        //print_r($arreglo[0]['cod_user']);
        $token = $arreglo[1];


        return response()->json([
            'token' => $token,
            'success' => true
        ], 200);


    }

    public function storeFuncionario(Request $request)
    {
        try {
            $datosGenerales = $request->json()->all();
            /**
             * INFORMACION COMPLEMENTARIA DEL PROFESIONAL
             */
            $tipoFuncionario = $datosGenerales['cod_tipo_usuario'];
            $dataProfesional = $datosGenerales['cod_personal_cinda']['cod_informacion_complementaria_empleado'];
            $dataPersonal = $datosGenerales['cod_personal_cinda']['cod_informacion_personal_empleado'];
            $idEmpleadoInformacionComplementaria = $this->informacionComplementariaEmpleadoController->storeLocal($dataProfesional)->cod_informacion_complementaria_empleado;
            /**
             * INFORMACION DEL USER
             */
            $dataProfesional = array();
            $dataProfesional['email'] = $dataPersonal['empleado_correo_electronico'];
            $dataProfesional['name'] = $dataPersonal['empleado_correo_electronico'];
            $correo = $dataPersonal['empleado_correo_electronico'];
            $dataProfesional['password'] = Hash::make($dataPersonal['empleado_documento_id']);
            $dataProfesional['fecha_registro'] = now();
            $dataProfesional['fecha_cambio_clave'] = now();
            $dataProfesional['fecha_ultimo_ingreso'] = now();
            $dataProfesional['estado_usuario'] = 1;
            $dataProfesional['codigo_sesion'] = 1000;

            /**
             * 1. Superadministrador
             * 2. Coordinador
             * 3. Profesionales
             * 4. Administrativo
             * 5. Auditor
             */
            $dataProfesional['cod_tipo_usuario'] = $tipoFuncionario;
            $arreglo = $this->userController->localregister($dataProfesional);
            $idUsuarioAplicativo = ($arreglo[0]['cod_user']);
            $token = $arreglo[1];


            /**
             * INFORMACION PERSONAL DEL PROFESIONAL
             */
            $dataProfesional = $datosGenerales['cod_personal_cinda']['cod_informacion_personal_empleado'];
            $idEmpleadoInformacionPersonal = $this->informacionPersonalEmpleadoController->storeLocal($dataProfesional)->cod_informacion_personal_empleado;
            /**
             * INFORMACION DEl PERSONAL CINDA
             */
            $dataProfesional = array();
            $dataProfesional["cod_informacion_personal_empleado"] = $idEmpleadoInformacionPersonal;
            $dataProfesional["cod_informacion_complementaria_empleado"] = $idEmpleadoInformacionComplementaria;
            $dataProfesional["cod_estado_personal"] = 1;
            $dataProfesional["cod_usuario_aplicativo"] = $idUsuarioAplicativo;
            $idPersonalaCinda = $this->personalCindaController->storeLocal($dataProfesional)->cod_personal_cinda;
            /**
             * INFORMACION DEL PROFESIONAL CINDA
             */


            $datosProfesional["cod_area"] = $datosGenerales['cod_area'];
            $datosProfesional["cod_personal_cinda"] = $idPersonalaCinda;
            $idProfesional = $this->profesionalCindaController->storeLocal($datosProfesional)->cod_profesional_cinda;


            /*
             * Enviar correo
             */
            $this->correoController->sendMailBienvenida($correo);

        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false], 200);
        }

        return response()->json([
            'message' => '¡Se registro exitosamente!',
            'token' => $token,
            'success' => true
        ], 200);

    }

    public function editFuncionario(Request $request)
    {

        try {
            $datosGenerales = $request->json()->all();

            /**
             * INFORMACION COMPLEMENTARIA DEL PROFESIONAL
             */
            $idEmpleadoInformacionComplementaria = $datosGenerales['cod_informacion_complementaria_empleado'];
            $dataPersonal = $datosGenerales['cod_personal_cinda']['cod_informacion_complementaria_empleado'];
            $idEmpleado = $this->informacionComplementariaEmpleadoController->updateLocal($dataPersonal, $idEmpleadoInformacionComplementaria);
            /**
             *
             * INFORMACION PERSONAL DEL PROFESIONAL
             */
            $idEmpleadoInformacionPersonal = $datosGenerales['cod_informacion_personal_empleado'];
            $dataProfesional = $datosGenerales['cod_personal_cinda']['cod_informacion_personal_empleado'];
            $this->informacionPersonalEmpleadoController->updateLocal($dataProfesional, $idEmpleadoInformacionPersonal);

            $idProfesional = $datosGenerales['cod_profesional_cinda'];
            $dataProfesional['cod_area'] = $datosGenerales['cod_area'];
            $this->profesionalCindaController->updateLocal($dataProfesional, $idProfesional);



        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
                'success' => false], 200);
        }
        return response()->json([
            'message' => '¡Se edito exitosamente!',
            'success' => true
        ], 200);
    }


    public function editProfile(Request $request)
    {
        try {
            $datosGenerales = $request->json()->all();
            $dataUser = $datosGenerales;
            $idUserAplicativo = $datosGenerales['cod_user'];
            $dataUser['password'] = Hash::make($datosGenerales['newPassword']);
            $dataUser['fecha_cambio_clave'] = now();
            $this->userController->updateLocal($dataUser, $idUserAplicativo);

        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Sucedio un error!',
                'success' => false], 200);
        }

        return response()->json([
            'message' => '¡Se actualizo exitosamente!',
            'success' => true
        ], 200);

    }

    public function verificarCodigo(Request $request)
    {
        try {
            $datosGenerales = $request->json()->all();
            $dataUser = $datosGenerales;
            $cod = $datosGenerales['cod'];
            $correo = $datosGenerales['email'];
            $user = DB::select('select cod_user, codigo_sesion from users where email =?', [$correo]);
            if ($cod == $user[0]->codigo_sesion) {
                return response()->json([
                    'message' => '¡Código correcto!',
                    'success' => true
                ], 200);
            } else {
                return response()->json([
                    'message' => '¡Código erroneo!',
                    'success' => false
                ], 200);
            }
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Sucedio un error!',
                'success' => false], 200);
        }
    }

    public function cambiarClave(Request $request)
    {
        try {
            $datosGenerales = $request->json()->all();
            $dataUser = $datosGenerales;
            $cod = $datosGenerales['cod'];
            $correo = $datosGenerales['email'];
            $user = DB::select('select cod_user, codigo_sesion from users where email =?', [$correo]);
            if ($cod == $user[0]->codigo_sesion) {
                $idUserAplicativo = $user[0]->cod_user;
                $dataUser['password'] = Hash::make($datosGenerales['newPassword']);
                $dataUser['fecha_cambio_clave'] = now();
                $this->userController->updateLocal($dataUser, $idUserAplicativo);
            } else {
                return response()->json([
                    'message' => '¡Código erroneo!',
                    'success' => true
                ], 200);
            }
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Sucedio un error!',
                'success' => false], 200);
        }

        return response()->json([
            'message' => '¡Se actualizo exitosamente!',
            'success' => true
        ], 200);
    }

    public function storeEvolucionPED(Request $request)
    {
        try {

            $datosGenerales = $request->json()->all();

            $mes = $datosGenerales['cod_mes'];
            $anio = $datosGenerales['anio_evolucion'];
            $cod_usuario = $datosGenerales['cod_usuario_panda'];
            $evolucion = $this->evolucion_mensual_ped->validarMes($cod_usuario,$mes, $anio);
            if($evolucion){
                return response()->json([
                    'message' => '¡Ya existe una evolución con ese mes!',
                    'success' => false
                ], 200);
            }

            $dataSesionesPed = $datosGenerales['cantidad_sesiones'];
            $idCantidadSesiones = $this->cantidad_sesiones_ped->storeLocal($dataSesionesPed)->cod_cantidad_sesiones_usuario;
            $datosGenerales['numero_sesiones'] = $idCantidadSesiones;
            $datosGenerales['cod_estado_evolucion'] = 1;
            $newElement = $this->evolucion_mensual_ped->storeLocal($datosGenerales);

            $data = $this->evolucion_mensual_ped->getInfoXCodUsuario($newElement['cod_usuario_panda']);
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false], 200);
        }
        return response()->json([
            'data' => $data,
            'message' => '¡Se registro exitosamente!',
            'success' => true
        ], 200);
    }


    public function editarEvolucionPED(Request $request){
        try {

            $datosGenerales = $request->json()->all();

            $dataSesionesPed = $datosGenerales['cantidad_sesiones'];
            $id = $datosGenerales['cod_cantidad_sesiones_usuario'];
            $this->cantidad_sesiones_ped->updateLocal($dataSesionesPed, $id);
            $data = $this->evolucion_mensual_ped->getInfoXCodUsuario($datosGenerales['cod_usuario_panda']);
        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false], 200);
        }
        return response()->json([
            'data' => $data,
            'message' => '¡Se registro exitosamente!',
            'success' => true
        ], 200);
    }

    public function storeRegistroPedAcumulado(Request $request)
    {

        try {
            $datosGenerales = $request->json()->all();
            $idRegistro = $datosGenerales['cod_registro_ped'];
            $objeto = array();
            $objeto['estado_registro_ped'] = 1;
            $objeto['fecha_registro_ped'] = now('UTC');
            $objeto['cod_horario_sesion'] =  $datosGenerales['cod_horario_sesion'];
            $objeto['cod_evolucion_ped'] = $datosGenerales['cod_evolucion_ped'];
            $this->registroPedController->updateLocal($objeto, $idRegistro);

        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error' . $e->getMessage(),
                'success' => false], 200);
        }
        return response()->json([
            'message' => '¡Se registro exitosamente!',
            'success' => true
        ], 200);
    }

    public function storeRegistroPed(Request $request)
    {

        //try {
            $datosGenerales = $request->json()->all();
            $sesion = $datosGenerales;
            $sesion['estado_registro_ped'] = $datosGenerales['estado_registro_ped'];
            if ($sesion['estado_registro_ped'] == 1) {
                //$date = new DateTime("now", new DateTimeZone('America/Bogota'));
                $sesion['fecha_registro_ped'] = now('UTC');
            } else {
                $sesion['fecha_registro_ped'] = null;
            }
            $this->registroPedController->storeLocal($sesion);
         /**}
        catch (Throwable $e) {
            return response()->json([
                'message' => 'Sucedio un error!',
                'success' => false], 200);
        }*/
        return response()->json([
            'message' => '¡Se registro exitosamente!',
            'success' => true
        ], 200);
    }

    public function storeValoraciones(Request $request)
    {
        try {
            $datosGenerales = $request->json()->all();
            $idUsuarioPanda = $datosGenerales['idUsuarioPanda'];
            $idProfesional = $datosGenerales['idProfesional'];
            /**
             * DIAGNOSTICO CIF
             */
            $dataCif = $datosGenerales['diagnosticoCif'];
            $dataCif['cod_usuario_panda'] = $idUsuarioPanda;
            $this->diagnosticoCifController->storeLocal($dataCif);

            /**
             * DIAGNOSTICO CIE
             */
            $dataCie = $datosGenerales['diagnosticoCie'];
            $dataCie['cod_usuario_panda'] = $idUsuarioPanda;
            $this->diagnosticoCieController->storeLocal($dataCie);


            /**
             * USUARIO_FORMULARIO_VALORACION
             */
            $dataUsuarioFormulario = $datosGenerales['UsuarioFormularioValoracion'];
            // MANDAR DESDE FRONT
            //$dataUsuarioFormulario['cod_tipo_formulario_valoracion'] = $datosGenerales[''] ;
            $dataUsuarioFormulario['cod_usuario_panda'] = $idUsuarioPanda;
            $dataUsuarioFormulario['cod_profesional'] = $idProfesional;
            $date = new DateTime("now", new DateTimeZone('America/Bogota'));
            $dataUsuarioFormulario['fecha_registro_formulario'] =$date;
            $codFormularioValoracion = $this->usuarioFormularioValoracionController->storeLocal($dataUsuarioFormulario)->cod_usuario_formulario_valoracion;

            /**
             * RESPUESTA_INFORMACION FORMULARIO
             */
            $dataRespuestaInformacion = $datosGenerales['respuesta_formulario'];
            foreach ($dataRespuestaInformacion as $r) {
                $filaRespuesta = $r;
                $filaRespuesta['cod_informacion_formularios_valoracion'] = $r['cod_respuesta'];
                $filaRespuesta['cod_usuario_formulario_valoracion'] = $codFormularioValoracion;
                $this->RespuestaInformacionFormularioController->storeLocal($filaRespuesta);
            }

        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Sucedio un error!',
                'success' => false], 200);
        }
        return response()->json([
            'message' => '¡Se registro exitosamente!',
            'success' => true
        ], 200);
    }

    public function storeDocumentos(Request $request)
    {
        try {
            $datosGenerales = $request->json()->all();
            $idUsuario = $datosGenerales['cod_usuario_panda'];
            $documentosUsuario = $datosGenerales['documentos_usuario'];
            /**
             * Variable que almacena el estado de la petición: si cambia de estado el usuario panda o no
             * 0 -> NO SE CAMBIA
             * 1 -> SE CAMBIA
             */
            $estado = $datosGenerales['status_usuario'];
            foreach ($documentosUsuario as $d) {
                $fila = $d;
                $fila['cod_usuario_panda'] = $idUsuario;
                $tipoDocumento = $fila['cod_tipo_documento_fisico'];
                $existe = DB::select('select * from documentos_usuario_panda where cod_usuario_panda = ? and cod_tipo_documento_fisico= ?',
                    [$idUsuario, $tipoDocumento]);
                if ($existe) {
                    $this->DocumentosPandaController->updateLocal($fila, $fila['cod_documentos_usuario_panda']);
                } else {
                    $this->DocumentosPandaController->storeLocal($fila);
                }
            }

            if ($estado == 1) {
                $this->pandaUsuarioController->cambiarEstadoUsuarioPanda($idUsuario, 3);
            }


        } catch (Throwable $e) {
            return response()->json([
                'data' => $e->getMessage(),
                'message' => 'Sucedio un error!',
                'success' => false], 200);
        }

        return response()->json([
            'message' => '¡Se registro exitosamente!',
            'success' => true
        ], 200);

    }

    public function updateDocumentos(Request $request)
    {
        try {
            $datosGenerales = $request->json()->all();
            $documentosUsuario = $datosGenerales['documentos_usuario'];
            foreach ($documentosUsuario as $d) {
                $fila = $d;
                $this->DocumentosPandaController->updateLocal($fila, $fila->cod_documentos_usuario_panda);
            }
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Sucedio un error!',
                'success' => false], 200);
        }

        return response()->json([
            'message' => '¡Se actualizo exitosamente!',
            'success' => true
        ], 200);

    }

    public function updateAsignacion(Request $request)
    {
        try {
            $datosGenerales = $request->json()->all();
            $codNino = $datosGenerales['cod_nino_panda'];
            $result = $this->asignacionProfesionalesController->updateLocal($datosGenerales, $codNino);
        } catch (Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Sucedio un error!',
                'success' => false], 200);
        }
        return response()->json([
            'data' => $result,
            'message' => '¡Se actualizo exitosamente!',
            'success' => true
        ], 200);
    }


    public function updateDiagnosticos(Request $request)
    {
        try {
            $datosGenerales = $request->json()->all();
            $diagnosticoCie = $datosGenerales['diagnostico_cie'];
            $diagnosticoCif = $datosGenerales['diagnostico_cif'];
            foreach ($diagnosticoCie as $d) {
                $fila = $d;
                $cod_diagnostico = $fila['cod_diagnostico_cie_usuario'];
                $existe = DB::select('select * from diagnostico_cie_usuario where cod_diagnostico_cie_usuario = ?',
                    [$cod_diagnostico]);
                if ($existe) {
                    $this->diagnosticoCieController->updateLocal($fila,$cod_diagnostico);
                }else {
                    $this->diagnosticoCieController->storeLocal($fila);
                }
            }


            foreach ($diagnosticoCif as $d) {
                $fila = $d;
                $cod_diagnostico = $fila['cod_diagnostico_cif_usuario'];
                $existe = DB::select('select * from diagnostico_cif_usuario where cod_diagnostico_cif_usuario = ?',
                    [$cod_diagnostico]);
                if ($existe) {
                    $this->diagnosticoCifController->updateLocal($fila,$cod_diagnostico);
                }else {
                    $this->diagnosticoCifController->storeLocal($fila);
                }
            }
        } catch (Throwable $e) {
            return response()->json([
                'data' => $e->getMessage(),
                'message' => 'Sucedio un error!',
                'success' => false], 200);
        }

        return response()->json([
            'message' => '¡Se registro exitosamente!',
            'success' => true
        ], 200);

    }


}
