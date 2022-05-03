<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use JWTAuth;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $datosGenerales = $request->json()->all();
        try {
            $myTTL = 1440; //min
            JWTAuth::factory()->setTTL($myTTL);
            if (!$token = JWTAuth::attempt($datosGenerales)) {
                return response()->json(['error' => 'invalid_credentials',
                    'token' => $token], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = JWTAuth::user();
        $user->token = $token;

        return response()->json([
            'data' => $user,
            'message' => "Successfully updated",
            'success' => true
        ], 200);
    }


    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function localregister($infoUsuario)
    {
        $usuario = User::create($infoUsuario);
        $token = JWTAuth::fromUser($usuario);
        $arreglo = [$usuario, $token];
        return $arreglo;
    }

    public function updateLocal($informacion, $id)
    {
        return User::find($id)->update($informacion);
    }

    public function generateCod()
    {
        $codigo = "";
        for ($i = 0; $i < 6; $i++) {
            $numero = rand(0, 9);
            $codigo = $numero . "" . $codigo;
        }
        return $codigo;
    }

    public function actualizarCodigo($id, $cod)
    {
        $objeto['codigo_sesion'] = $cod;
        $this->updateLocal($objeto, $id);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


}
