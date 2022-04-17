<?php

namespace App\Http\Controllers;

use App\Mail\CorreoPassword;
use App\Mail\CorreoWelcome;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Mail;
use Throwable;

class CorreosController extends Controller
{
    public function sendMail(Request $request)
    {
        try {
            $datosGenerales = $request->json()->all();
            $correo = $datosGenerales['email'];
            $nom = DB::select('select * from nomusuarioxcorreo where email =?', [$correo]);
            if (!$nom) {
                return response()->json([
                    'message' => '¡Correo incorrecto!',
                    'success' => false], 200);
            } else {
                $u = new UserController();
                $codAleatorio = $u->generateCod();
                $codUser = $nom[0]->cod_user;
                $u->actualizarCodigo($codUser, $codAleatorio);

                $mensaje['nombres'] = $nom[0]->nombres;
                $mensaje['apellidos'] = $nom[0]->apellidos;
                $mensaje['cod'] = $codAleatorio;

                Mail::to($correo)->send(new CorreoPassword($mensaje));
            }

        } catch (Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false], 200);
        }
        return response()->json([
            'message' => "Se envió el correo correctamente",
            'success' => true
        ], 200);
    }

    public function sendMailBienvenida1(Request $request)
    {
        $datosGenerales = $request->json()->all();
        $correo = $datosGenerales['email'];
        $nom = DB::select('select * from nomusuarioxcorreo where email =?', [$correo]);
        if (!$nom) {
            return response()->json([
                'message' => '¡Correo incorrecto!',
                'success' => false], 200);
        } else {
            $mensaje['nombres'] = $nom[0]->nombres;
            $mensaje['apellidos'] = $nom[0]->apellidos;

            Mail::to($correo)->send(new CorreoWelcome($mensaje));
        }


        return response()->json([
            'message' => "Se envió el correo correctamente",
            'success' => true
        ], 200);
    }


    public function sendMailBienvenida($email)
    {
        try {
            $correo = $email;
            $nom = DB::select('select * from nomusuarioxcorreo where email =?', [$correo]);
            if (!$nom) {
                return response()->json([
                    'message' => '¡Correo incorrecto!',
                    'success' => false], 200);
            } else {
                $mensaje['nombres'] = $nom[0]->nombres;
                $mensaje['apellidos'] = $nom[0]->apellidos;

                Mail::to($correo)->send(new CorreoWelcome($mensaje));
            }

        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Sucedio un error!',
                'success' => false], 200);
        }

        return response()->json([
            'message' => "Se envió el correo correctamente",
            'success' => true
        ], 200);
    }
}
