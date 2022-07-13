<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfesorController extends Controller
{
    public function register(Request $resquest)
    {
        $resquest->validate(
            [
                'Nom_Profesor' => 'required',
                'Nom_Usuario' => 'required|unique:Estudiantes',
                'Dir_img' => 'required',
                'email' => 'required|email|unique:Estudiantes',
                'password' => 'required|confirmed',

            ]);

                $profesor = new profesor();
                $profesor->Tipo='Profesor';
                $profesor->Nom_Profesor = $resquest->Nom_Profesor;
                $profesor->Nom_Usuario = $resquest->Nom_Usuario;
                $profesor->Dir_img = $resquest->Dir_img;
                $profesor->email = $resquest->email;
                $profesor->password = Hash::make($resquest->password);
                $profesor->save();

                return response()->json(
                    [
                        "status" => true,
                        "msg" => "Registro de usuario exitoso!"
                    ]
                );
    }

    public function login(Request $resquest)
    {

        $resquest->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $profesor = profesor::where("email", "=", $resquest->email)->first();
        if (isset($profesor->id)) {
            if (Hash::check($resquest->password, $profesor->password)) {
                $token = $profesor->createToken("auth_token")->plainTextToken;
                return response()->json(
                    [
                        "status" => true,
                        "msg" => "¡Usuario logueado correctamente!",
                        "access_token" => $token
                    ]
                );
            } else {
                return response()->json(
                    [
                        "status" => false,
                        "msg" => "algun dato es incorrecto!"
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    "status" => false,
                    "msg" => "Usuario no registrado!"
                ]
            );
        }
    }

    public function userProfile()
    {
        return response()->json(
            [
                "status" => true,
                "msg" => "Informacion del usuario",
                "data" => auth()->user()

            ]
        );
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json(
            [
                "status" => true,
                "msg" => "Cierre sesion"


            ]
        );
    }
}
