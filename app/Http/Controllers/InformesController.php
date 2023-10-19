<?php

namespace App\Http\Controllers;


use App\Models\UsuarioPanda;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Imagick;
use Nette\Utils\Image;
use phpDocumentor\Reflection\Utils;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Tcpdf;
use Throwable;
use function Illuminate\Support\Str;

class InformesController extends Controller
{


    public function exportarActa($id, $evolucion)
    {

        //----------------Get data----------

        $ninoPanda = DB::select('select * from usuario_panda_info where cod_usuario_panda =?', [$id]);
        $eps = DB::select('select nom_administrador_plan_beneficios from eps_paciente where cod_usuario_panda =?', [$id]);
        /**
         *         $count = DB::select('select count(*) as total from ped_nino where estado_registro_ped = 1 and cod_usuario_panda = ?
         * and cod_evolucion_ped=?', [$id,$evolucion]);
         */
        $ped = DB::select('select numero_sesiones, nom_mes, anio_evolucion
                                    from evolucion_mensual_ped, mes
                                    where evolucion_mensual_ped.cod_mes = mes.cod_mes and
                                          cod_usuario_panda = ? and cod_evolucion_mensual_ped=?', [$id, $evolucion]);

        //-------------Remplace data--------------

        $templateProcessor = new TemplateProcessor('reportTemplates/acta_recibido_sesiones.docx');

        //TODO HACER MES ANO
        $templateProcessor->setValue('mes', $ped[0]->nom_mes);
        $templateProcessor->setValue('ano', $ped[0]->anio_evolucion);

        $templateProcessor->setValue('fecha', date("Y-m-d"));
        $templateProcessor->setValue('tipo_id', $ninoPanda[0]->nom_tipo_documento_identificacion);
        $templateProcessor->setValue('num_id', $ninoPanda[0]->panda_documento_id);

        $templateProcessor->setValue('nombre_nino', $ninoPanda[0]->nombres . ' ' . $ninoPanda[0]->apellidos);
        $templateProcessor->setValue('eps', $eps[0]->nom_administrador_plan_beneficios);

        $fileName = $ninoPanda[0]->nombres . " - Acta De Satisfacción.docx";
        $templateProcessor->saveAs($fileName);

        $dataFile = public_path(($fileName), $fileName);
        $file = file_get_contents($dataFile);
        $data = base64_encode($file);
        unlink($dataFile);

        //------------------------

        return response()->json([
            'message' => '¡Descarga exitosamente!',
            'data' => [
                'name' => $fileName,
                'data' => $data
            ],
            'success' => true
        ], 200);

    }

    public function exportarPed($id, $evolucion, $area)
    {

        try {
            $ninoPanda = DB::select('select * from usuario_panda_info where cod_usuario_panda =?', [$id]);
            $f = null;
            $fono = false;
            $teo = false;
            $psico = false;
            $fisio = false;
            $firma = "";
            $codProfesional = 0;
            if ($area == 0) {
                $ped = DB::select('select * from ped_nino where estado_registro_ped = 1 and cod_usuario_panda = ?
                         and cod_evolucion_ped=? ORDER BY fecha_registro_ped ASC, ped_nino.detalle_horario_sesion', [$id, $evolucion]);
                $diagnostico = DB::select('select * from diagnostico_ciexUsuario where cod_usuario_panda = ?
                                        and cod_tipo_diagnostico=1', [$id]);
                $f = true;
            }elseif($area == 1  or $area == 3 or $area == 6 or $area == 7 or $area == 8){
                $ped = DB::select('select * from ped_nino where estado_registro_ped = 1 and cod_usuario_panda = ?
                         and cod_evolucion_ped=? and (cod_area_general=1 or cod_area_general=3 or
                         cod_area_general=6 or cod_area_general=7 or cod_area_general=8)
                        ORDER BY fecha_registro_ped ASC, ped_nino.detalle_horario_sesion ',
                    [$id, $evolucion]);
                $diagnostico = DB::select('select * from diagnostico_ciexUsuario where cod_usuario_panda = ?
                                        and cod_tipo_diagnostico=1', [$id]);
                $fono=true;
                $asignacion_profesionales= DB::select('select nom_fonoaudiologa, cod_fonoaudiologa from
                              vista_asignacion_profesionales where cod_nino_panda =?', [$id]);

                $firma = DB::select('select * from  profesionales_firmas where cod_profesional =?',
                    [$asignacion_profesionales[0]->cod_fonoaudiologa]);

            }
            else {
                $ped = DB::select('select * from ped_nino where estado_registro_ped = 1 and cod_usuario_panda = ?
                         and cod_evolucion_ped=? and cod_area_general=? ORDER BY fecha_registro_ped ASC',
                    [$id, $evolucion, $area]);
                $diagnostico = DB::select('select * from diagnostico_ciexUsuario where cod_usuario_panda = ?
                                        and cod_tipo_diagnostico=?', [$id, $area]);
                $asignacion_profesionales= DB::select('select * from
                              vista_asignacion_profesionales where cod_nino_panda =?', [$id]);
                if($area==2){
                    $psico = true;
                }elseif ($area==4){
                    $teo = true;
                }elseif ($area==5){
                    $fisio = true;
                }

            }


            if( !$ninoPanda || !$ped) {
                return response()->json([
                    'message' => "Ha ocurrido un error. Verifique que el usuario tenga sesiones registradas.",
                    'success' => false], 200);
            }

            if($fono){
                $filename = 'PED-Fonoaudiologia -' . trim($ninoPanda[0]->nombres).'.xlsx';
            }elseif ($f){
                $filename = 'PED-GENERAL' . $ninoPanda[0]->nombres.'.xlsx';
            }else{
                $filename = 'PED -'. $ped[0]->nom_area. ' - '. $ninoPanda[0]->nombres. '.xlsx';
            }

            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('reportTemplates/plantilla_ped_excel.xlsx');
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet->setTitle("PED -" . $ninoPanda[0]->nombres);



            if ($f) {
                $worksheet->getCell("C3")->setValue('PED GENERAL');
                $worksheet->getCell("E10")->setValue('PED GENERAL');

            } else {
                if($fono){
                    $worksheet->getCell("C3")->setValue("Fonoaudiologia");
                    $worksheet->getCell("E10")->setValue("Fonoaudiologia");
                    $worksheet->getCell("G262")->setValue("Fonoaudiologia");

                }else {
                    $worksheet->getCell("C3")->setValue($ped[0]->nom_area);
                    $worksheet->getCell("E10")->setValue($ped[0]->nom_area);
                    $worksheet->getCell("G262")->setValue($ped[0]->nom_area);
                }
            }


            $worksheet->getCell("D5")->setValue($ped[0]->nom_mes);
            $worksheet->getCell("G5")->setValue($ped[0]->anio_evolucion);
            $worksheet->getCell("C6")->setValue($ninoPanda[0]->nombres . ' ' . $ninoPanda[0]->apellidos);
            $worksheet->getCell("C6")->setValue($ninoPanda[0]->nombres . ' ' . $ninoPanda[0]->apellidos);
            if($diagnostico){
                $worksheet->getCell("A9")->setValue($diagnostico[0]->nom_tipo_diagnostico);
                $worksheet->getCell("D9")->setValue($diagnostico[0]->value_estandar_cie . '  ' . $diagnostico[0]->nom_estandar_cie);
            }else{
                $worksheet->getCell("A9")->setValue("TIPO DIAGNOSTICO");
                $worksheet->getCell("D9")->setValue("Área sin diagnostico");
            }
            $worksheet->getCell("G6")->setValue($ninoPanda[0]->panda_documento_id);
            $worksheet->getCell("c7")->setValue($ninoPanda[0]->panda_fecha_nacimiento);



            $i = 12;
            foreach ($ped as $fila) {
                if ($fila) {
                    $worksheet->getCell("B$i")->setValue($fila->detalle_horario);
                    $worksheet->getCell("C$i")->setValue($fila->fecha_registro_ped);
                    $worksheet->getCell("H$i")->setValue($fila->NombreEmpleado);

                    for ($x = 1; $x < 7; $x++) {
                        if ($x == 1) {
                            $worksheet->getCell("D$i")->setValue($fila->descripcion_inicio);
                            $i++;
                        } elseif ($x == 2) {
                            $worksheet->getCell("D$i")->setValue($fila->detalle_objetivo_ped);
                            $i++;
                        } elseif ($x == 3) {
                            $worksheet->getCell("D$i")->setValue($fila->detalle_actividad_registro);
                            $i++;
                        } elseif ($x == 4) {
                            $worksheet->getCell("D$i")->setValue($fila->detalle_resultado_registro);
                            $i++;
                        } elseif ($x == 5) {
                            $worksheet->getCell("D$i")->setValue($fila->detalle_recomendacion_registro);
                            $i++;
                        } else {
                            $worksheet->getCell("D$i")->setValue($fila->descripcion_final);
                            $i++;
                        }
                    }
                }
            }



           for ($x = $i; $x <= 252; $x++){
               $spreadsheet->getActiveSheet()->getRowDimension($x)->setVisible(false);
           }


           $drawing = new Drawing();
            if($f){
                $worksheet->getCell("G261")->setValue("PED general");
            }else{
                if($fono){
                    $worksheet->getCell("G261")->setValue($asignacion_profesionales[0]->nom_fonoaudiologa);
                    $worksheet->getCell("G261")->setValue($asignacion_profesionales[0]->nom_fonoaudiologa);
                }elseif ($teo){
                    $worksheet->getCell("G261")->setValue($asignacion_profesionales[0]->nom_teo);
                    //$firma = DB::select('select * from  profesionales_firmas where cod_profesional =?',
                      //  [$asignacion_profesionales[0]->cod_teo]);
                }elseif ($fisio){
                    $worksheet->getCell("G261")->setValue($asignacion_profesionales[0]->nom_fisioterapia);
                    //$firma = DB::select('select * from  profesionales_firmas where cod_profesional =?',
                      //  [$asignacion_profesionales[0]->cod_fisioterapia]);
                }elseif ($psico){
                    $worksheet->getCell("G261")->setValue($asignacion_profesionales[0]->nom_psicologia);
                     //$firma = DB::select('select * from  profesionales_firmas where cod_profesional =?',
                       // [$asignacion_profesionales[0]->cod_psicologa]);
                }else{
                    $worksheet->getCell("G261")->setValue("Sin asignación");
                }

                $drawing->setPath('reportTemplates/firma.png');
                $drawing->setHeight(90);
                $drawing->setCoordinates('E255');
                $drawing->setOffsetX(100);
                $drawing->setWorksheet($spreadsheet->getActiveSheet());

            }


            $writer = new Xlsx($spreadsheet);
            $writer->save($filename);
            $dataFile = public_path(($filename), $filename);
            $file = file_get_contents($dataFile);
            $data = base64_encode($file);
            unlink($dataFile);

        }catch (Throwable $e) {
            return response()->json([
                'message' => "Ha ocurrido un error. " . $e->getMessage(),
                'success' => false], 200);
        } catch (Exception $e) {
        } catch (\ImagickException $e) {
        }
        return response()->json([
            'message' => '¡Descarga exitosamente!',
            'data' => [
                'name' => $filename,
                'data' => $data
            ],
            'success' => true
        ], 200);
    }

    public function exportarPlanillaFirmas($id, $evolucion, $descarga)
    {
        try {
            $ninoPanda = DB::select('select * from usuario_panda_info where cod_usuario_panda =?', [$id]);
            $ped = DB::select('select * from ped_nino where cod_usuario_panda = ? and cod_evolucion_ped=?
                         and estado_registro_ped=1 order by fecha_registro_ped ASC ', [$id, $evolucion]);
            $eps = DB::select('select nom_administrador_plan_beneficios from eps_paciente where cod_usuario_panda =?', [$id]);
            $filename = 'Planilla Firmas-' . $ninoPanda[0]->nombres . '.xlsx';

            if( !$ninoPanda || !$ped) {
                return response()->json([
                    'message' => "Ha ocurrido un error. Verifique que el usuario tenga sesiones registradas.",
                    'success' => false], 200);
            }


            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('reportTemplates/Formato_firmas.xlsx');
            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->setTitle("PED -" . $ninoPanda[0]->nombres);
            $worksheet->getCell("C6")->setValue($ninoPanda[0]->nombres . ' ' . $ninoPanda[0]->apellidos);

            $worksheet->getCell("D5")->setValue($ped[0]->nom_mes);
            $worksheet->getCell("G5")->setValue($ped[0]->anio_evolucion);

            $worksheet->getCell("G6")->setValue($ninoPanda[0]->value_tipo_documento_identificacion . ' ' . $ninoPanda[0]->panda_documento_id);
            $worksheet->getCell("C7")->setValue($ninoPanda[0]->panda_fecha_nacimiento);
            $worksheet->getCell("F7")->setValue($eps[0]->nom_administrador_plan_beneficios);

            $i = 11;
            foreach ($ped as $fila) {
                if ($fila) {
                    if($fila->cod_area_general == 1 or $fila->cod_area_general == 3 or $fila->cod_area_general == 6 or
                        $fila->cod_area_general == 7 or $fila->cod_area_general == 8 ){
                        $worksheet->getCell("B$i")->setValue("Fonoaudiologia");
                        $worksheet->getCell("C$i")->setValue($fila->fecha_registro_ped);
                    }else{
                        $worksheet->getCell("B$i")->setValue($fila->nom_area);
                        $worksheet->getCell("C$i")->setValue($fila->fecha_registro_ped);
                    }
                    $i++;
                }
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save('reportTemplates/'.$filename);
            $dataFile = public_path(('reportTemplates/'.$filename), $filename);
            $file = file_get_contents($dataFile);
            $data = base64_encode($file);
            /**
             * Indica si se quiere descargar o solo mostrar el pdf
             * 1 = mostrar pdf
             * 2 = decarga
             */
            if($descarga==1){
                $excel = \PhpOffice\PhpSpreadsheet\IOFactory::load('reportTemplates/'.$filename);
                $pdf = new Tcpdf($excel);
                $filename = Str::replace('xlsx', 'pdf', $filename);
                $pdf->save($filename);
                $dataFilePdf = public_path(($filename), $filename);
                $file = file_get_contents($dataFilePdf);
                $data = base64_encode($file);
                unlink($dataFilePdf);
            }

            unlink($dataFile);
        }catch (Throwable $e) {
            return response()->json([
                'message' => "Ha ocurrido un error. " . $e->getMessage(),
                'success' => false], 200);
        }
        return response()->json([
            'message' => '¡Descarga exitosamente!',
            'data' => [
                'name' => $filename,
                'data' => $data
            ],
            'success' => true
        ], 200);
    }


    public function exportarEntrevista($id)
    {
        try {
            $ninoPanda = DB::select('select * from usuario_panda_info where cod_usuario_panda =?', [$id]);
            $entrevista = DB::select('select * from entrevista_panda where entrevista_panda_entrevistador = ?', [$id]);
            $diagnostico = DB::select('select * from diagnostico_ciexUsuario where cod_usuario_panda = ? and cod_tipo_diagnostico=3', [$id]);
            $referencias = DB::select('select * from referencia_usuario where cod_usuario_panda =?', [$id]);
            $eps = DB::select('select nom_administrador_plan_beneficios from eps_paciente where cod_usuario_panda =?', [$id]);

            if( !$ninoPanda || !$entrevista) {
                return response()->json([
                    'message' => "Ha ocurrido un error. Verifique que el usuario tenga una entrevista inicial.",
                    'success' => false], 200);
            }

            $filename = 'Entrevista-' . $ninoPanda[0]->nombres . '.xlsx';

            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('reportTemplates/plantilla_entrevista.xlsx');
            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->setTitle("Entrevista-" . $ninoPanda[0]->nombres);
            $worksheet->getCell("A6")->setValue($ninoPanda[0]->nombres . ' ' . $ninoPanda[0]->apellidos);
            $worksheet->getCell("H6")->setValue($entrevista[0]->entrevista_panda_fecha);
            $worksheet->getCell("C8")->setValue($ninoPanda[0]->panda_fecha_nacimiento);

            $worksheet->getCell("C7")->setValue($ninoPanda[0]->nom_tipo_documento_identificacion);
            $worksheet->getCell("I7")->setValue($ninoPanda[0]->panda_documento_id);


            $worksheet->getCell("B12")->setValue($entrevista[0]->entrevista_panda_remite);
            //EPS
            $worksheet->getCell("I12")->setValue($eps[0]->nom_administrador_plan_beneficios);
            $worksheet->getCell("A14")->setValue($entrevista[0]->entrevista_panda_antecedentes);

            $worksheet->getCell("E11")->setValue($entrevista[0]->entrevista_panda_acompañante);
            $worksheet->getCell("B12")->setValue($entrevista[0]->entrevista_panda_etiologia);
            $worksheet->getCell("C16")->setValue($entrevista[0]->entrevista_panda_desarrollo_motor);

            /**
             * INFORMACION PADRES
             */
            $i = 9;
            foreach ($referencias as $fila) {
                $worksheet->getCell("C$i")->setValue($fila->nombre);
                $worksheet->getCell("I$i")->setValue($fila->referido_telefono_principal);
                $i++;
            }

            /**
             * DIAGNOSTICO AUDIOLOGICO
             */
            if(!$diagnostico){
                $worksheet->getCell("C17")->setValue('Sin diagnostico');
                $worksheet->getCell("C18")->setValue('Sin diagnostico');
            }else{
                $worksheet->getCell("C17")->setValue($diagnostico[0]->value_estandar_cie . '  ' . $diagnostico[0]->nom_estandar_cie);
                $worksheet->getCell("C18")->setValue($diagnostico[0]->detalle_diagnostico_cie);
            }


            $worksheet->getCell("C19")->setValue($entrevista[0]->entrevista_panda_deteccion);
            $worksheet->getCell("C20")->setValue($entrevista[0]->entrevista_panda_audifonos);
            $worksheet->getCell("I20")->setValue($entrevista[0]->entrevista_panda_baha);
            $worksheet->getCell("I21")->setValue($entrevista[0]->entrevista_panda_orl);
            $worksheet->getCell("C21")->setValue($entrevista[0]->entrevista_panda_inplante_coclear);
            $worksheet->getCell("C23")->setValue($entrevista[0]->entrevista_panda_comunicacion);
            $worksheet->getCell("C25")->setValue($entrevista[0]->entrevista_panda_integracion_educativa);
            $worksheet->getCell("A28")->setValue($entrevista[0]->entrevista_panda_recomendaciones);

            $writer = new Xlsx($spreadsheet);
            $writer->save($filename);
            $dataFile = public_path(($filename), $filename);
            $file = file_get_contents($dataFile);
            $data = base64_encode($file);
            unlink($dataFile);

            return response()->json([
                'message' => '¡Descarga exitosamente!',
                'data' => [
                    'name' => $filename,
                    'data' => $data
                ],
                'success' => true
            ], 200);

        } catch (Throwable $e) {
            return response()->json([
                'message' => "Ha ocurrido un error. " . $e->getMessage(),
                'success' => false], 200);
        }
    }

}
