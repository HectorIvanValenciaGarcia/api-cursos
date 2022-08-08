<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\infoCursando;
use App\Models\Cursos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\testmail;

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
             
            $curso= Cursos::where('id',$request->id_Cursos) ->get();

            $details =[
                'title'=>"Registro correcto al curso " . $curso[0]["Nom_Curso"],
                'body'=>"te registraste con exito al " . $curso[0]["Nom_Curso"],
                'descripcion'=>"Donde aprenderas a " .  $curso[0]["Descripcion"]

            ];
            Mail::to(auth()->user()->email)->send(new testmail($details));
            return response()->json(
                [
                    "status" => true,
                    "msg" =>"usuario registrado correctamente",
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
            $registroCursos= infoCursando::join("estudiantes", "estudiantes.id", "=", "info_cursando.id_Estudiante")
            ->select("*")
            ->where("estudiantes.id", "=", auth()->user()->id)
            ->get();
            //$registroCursos = infoCursando::where('id_Estudiante', auth()->user()->id)->get();
            if ($registroCursos->isEmpty()) {

                return response()->json(
                    [
                        "status" => false,
                        "msg" => "el estudiante no esta registrado en ningun curso",

                    ]
                );
            } else {
                //consulta de union y lo retorno dentro retunr
                
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
            
             
             $infoCurso = infoCursando::join("cursos", "cursos.id", "=", "info_cursando.id_Cursos")
             ->join("estudiantes", "estudiantes.id", "=", "info_cursando.id_Estudiante")
             ->where("info_cursando.id_Cursos", "=", $request->id_Cursos)
             ->select("*")
             ->get();
          /*  $infoCurso= infoCursando::join("estudiantes", "estudiantes.id", "=", "info_cursando.id_Estudiante")
            ->select("*")
            ->where("estudiantes.id", "=", auth()->user()->id)
            ->get();*/
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
