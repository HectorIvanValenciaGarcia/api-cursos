<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\lecciones;
use Illuminate\Http\Request;

class LeccionesController extends Controller
{
    //

    public function crearLeccion(Request $request)
    {
        if(auth()->user()->Tipo == "Profesor"){
            $request->validate(
                [
                    'id_Curso'=>'required',
                    'nombre'=>'required',
                    'descripcion'=>'required',
                ]);
                $leccion = new lecciones();
                $leccion->id_Curso = $request->id_Curso;
                $leccion ->nombre=$request->nombre;
                $leccion->descripcion=$request->descripcion;

                $leccion->save();
                return response()->json(
                    [
                        "status" => true,
                        "msg" =>"La leccion ". $leccion->nombre. "fue creado con exito!"
                    ]
                );

        }else{
            return response()->json(
                [
                    "status" => false,
                    "msg" => "Tu usuario no tiene permitido crear lecciones!"
                ]
            );  
        }
    }

    public function verLecciones(Request $request){
        $request->validate(
            [
                'id_Curso'=>'required'
            ]);
        $leccion= lecciones::where('id_Curso',$request->id_Curso) ->get();

            if($leccion->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No se tienen lecciones registradas',
                ]);
            } else {
                try {
                    return response()->json([
                        'status' => true,
                        'message' => 'Listado de lecciones consultado correctamente',
                        'data' => $leccion
                    ]);
                    
                } catch (\Throwable $th) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Error al intentar consultar listado de lecciones',
                        'error' => $th
                    ]);
                }
            }

    }

    public function abrirLeccion(Request $request){
        $request->validate(
            [
                'id_Leccion'=>'required'
            ]);
        $leccion= lecciones::where('id',$request->id_Leccion) ->get();

            if($leccion->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No se tiene la leccion registradas',
                ]);
            } else {
                try {
                    return response()->json([
                        'status' => true,
                        'message' => 'contenido de leccion',
                        'data' => $leccion
                    ]);
                    
                } catch (\Throwable $th) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Error al intentar consultar listado de lecciones',
                        'error' => $th
                    ]);
                }
            }


    }


}
