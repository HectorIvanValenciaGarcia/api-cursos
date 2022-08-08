<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cursos;
use App\Models\lecciones;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CursosController extends Controller
{


    public function crearCurso(Request $request)
    {

        if ( auth()->user()->Tipo == "Profesor") {
            $request->validate(
                [
                   
                    'Nom_Curso' => 'required',
                    'Descripcion' => 'required',
                    'Img_Curso' => 'required',
                    'Color' => 'required'

                ]
            );
            $curso = new Cursos();
            $curso->id_Profesor = auth()->user()->id;
            $curso->Nom_Curso = $request->Nom_Curso;
            $curso->Descripcion = $request->Descripcion;
            $curso->Img_Curso = $request->Img_Curso;
            $curso->Color = $request->Color;

            $curso->save();
            /* $ultimoCurso = Cursos::latest('id')->first()->id;*/
            


            return response()->json(
                [
                    "status" => true,
                    "msg" =>"El curso ". $curso->Nom_Curso. "fue creado con exito!"
                ]
            );
        }else{
            return response()->json(
                [
                    "status" => false,
                    "msg" => "Tu usuario no tiene permitido crear cursos!"
                ]
            );  
        }

    }

     public function verCursos(){

        $cursos= Cursos::join("profesor", "profesor.id", "=", "cursos.id_Profesor")
        ->select("*","cursos.id as id_curso")
            ->get();
            
    
            if(empty($cursos)) {
                return response()->json([
                    'status' => false,
                    'message' => 'No se tienen cursos registradas',
                ]);
            } else {
                try {
                    return response()->json([
                        'status' => true,
                        'message' => 'Listado de cursos consultado correctamente',
                        'data' => $cursos
                    ]);
                    
                } catch (\Throwable $th) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Error al intentar consultar listado de cursos',
                        'error' => $th
                    ]);
                }
            }
    
        }


public function caliCurso(){

    /*union entre tabla leccion y calificacion*/
    $cursos= lecciones::join("calificaciones", "calificaciones.id_Leccion", "=", "lecciones.id")
    ->select("*")
        ->get();

        return response()->json([
            'status' => false,
            'message' => $cursos
        ]);




}



     }









