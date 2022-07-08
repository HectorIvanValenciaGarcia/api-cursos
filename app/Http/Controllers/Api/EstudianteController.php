<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\estudiantes;
use Illuminate\Support\Facades\Hash;



class EstudianteController extends Controller
{
    public function register(Request $resquest){
        $resquest->validate(
        [
            'Nom_Estudiante'=> 'required',
            'Nom_Usuario'=> 'required|unique:Estudiantes',
            'Dir_img'=> 'required',
            'email'=>'required|email|unique:Estudiantes',
            'password'=>'required|confirmed',

        ]);

        $estudiante = new estudiantes();
        $estudiante -> Nom_Estudiante =$resquest->Nom_Estudiante ;
        $estudiante -> Nom_Usuario    =$resquest->Nom_Usuario    ;
        $estudiante -> Dir_img    =$resquest->Dir_img    ;
        $estudiante -> email          =$resquest->email          ;
        $estudiante -> password       = Hash::make($resquest->password);
        $estudiante -> save();

        return response() ->json(
            [
                "status" => true,
                "msg" => "Registro de usuario exitoso!"
            ]
            );
    }

    public function login(Request $resquest){

$resquest -> validate([
        'email'=>'required|email',
        'password'=>'required',
    ]);
    $student =estudiantes::where("email","=",$resquest->email)->first();
if(isset($student->id)){
    if(Hash::check($resquest->password, $student->password)){
$token = $student->createToken("auth_token")->plainTextToken;
return response() ->json(
    [
        "status" => true,
        "msg" => "¡Usuario logueado correctamente!",
        "access_token" => $token
    ]
    );


    }else{
        return response() ->json(
            [
                "status" => false,
                "msg" => "algun dato es incorrecto!"
            ]
            );
    }
}else{
    return response() ->json(
        [
            "status" => false,
            "msg" => "Usuario no registrado!"
        ]
        );
}




    }

    public function userProfile(){
        return response() ->json(
            [
                "status" => true,
                "msg" => "Informacion del usuario",
                "data" =>auth()->user()

            ]
            );
    }

    public function logout(){
auth()->user()->tokens()->delete();

        return response() ->json(
            [
                "status" => true,
                "msg" => "Cierre sesion"
               

            ]
            );


    }


}
