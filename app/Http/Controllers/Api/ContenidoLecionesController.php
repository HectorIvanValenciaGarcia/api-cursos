<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\contenidoLecciones;
use Illuminate\Http\Request;


class ContenidoLecionesController extends Controller
{
    //
    public function crearContenido(Request $request){

        if(auth()->user()->Tipo == "Profesor"){
            $request->validate(
                [
                    'id_Leccion'=>'required',
                    'contenido' =>'required',
                    'img'       =>'required'
                ]);

                $contenido= new contenidoLecciones();
                $contenido ->id_Leccion= $request ->id_Leccion;
                $contenido ->contenido = $request ->contenido;
                $contenido ->img       = $request ->img;     
                
                $contenido->save();
                return response()->json(
                    [
                        "status" => true,
                        "msg" =>"el contenido de la leccion ". $contenido. "fue creado con exito!"
                    ]
                );

        }

    }

    public function verContenido(Request $request){
        $request->validate(
            [
                'id_Leccion'=>'required',
                
            ]);

            $leccion= contenidoLecciones::where('id_Leccion',$request->id_Leccion) ->get();
            if($leccion->isEmpty()){
            return response()->json(
                [
                    "status" => false,
                    "msg" =>" no hay contenido en la leccion!",
                    'data' =>$leccion

                ]
            );}else{
                return response()->json(
                    [
                        "status" => true,
                        "msg" =>"el contenido de la leccion fue consultado con exito!",
                        'data' =>$leccion
    
                    ]
                ); 
                
            }


    }

}
