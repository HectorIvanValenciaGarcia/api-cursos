<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\infoCursando;
use Illuminate\Http\Request;


class InfoCursosController extends Controller
{
    public function registrarCurso(Request $request)
    {
        $request->validate(
            [
                
                'id_Cursos' => 'required',
                'puntuacion' => 'required',
            ]
        );

      if(auth()->user()->Tipo=="Estudiante"){
          try {
            $info = new infoCursando();
            $info->id_Estudiante = auth()->user()->id;
            $info->id_Cursos = $request->id_Cursos;
            $info->puntuacion = $request->puntuacion;
            $info->save();
            return response()->json(
                [
                    "status" => true,
                    "msg" => "Registro de curso exitoso!"
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "status" => false,
                    "msg" => "Error al registrar al usuario!",
                    "error" => $th
                ]
            );
        }
    }else{

        return response()->json(
            [
                "status" => false,
                "msg" => "El tipo de usuario no se puede registrar en el curso!",

            ]
        );
    }
    }

    public function verRegistros()
    {
      
        try {
            $registroCursos = infoCursando::where('id_Estudiante', auth()->user()->id)->get();
            if ($registroCursos->isEmpty()) {
                return response()->json(
                    [
                        "status" => false,
                        "msg" => "el estudiante no esta registrado en ningun curso",

                    ]
                );
            } else {
                return response()->json(
                    [
                        "status" => true,
                        "msg" => "Lista de cursos del estudiante logueado",
                        "data" => $registroCursos
                    ]
                );
            }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "status" => false,
                    "msg" => "Error al consultar registros!",
                    "error" => $th
                ]
            );
        }
    }

    public function estudiantesCursos(Request $request)
    {

        $request->validate(
            [
               
                'id_Cursos' => 'required',

            ]
        );
        try {
            $infoCurso = infoCursando::where('id_Cursos', $request->id_Cursos)->get();

           if($infoCurso->isEmpty()) {
           

            return response()->json(
                [
                    "status" => false,
                    "msg" => "El curso no cuenta con estudiantes :c",
                    
                ]
            );

        }else{
            return response()->json(
                [
                    "status" => true,
                    "msg" => "Estos son los estudiantes en rolados en el curso",
                    "data" => $infoCurso
                ]
            );
        }
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "status" => false,
                    "msg" => "Error al consultar registros!",
                    "error" => $th
                ]
            );
        }
    }
}
