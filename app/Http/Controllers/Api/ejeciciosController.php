<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ejercicios;
use Illuminate\Http\Request;

class ejeciciosController extends Controller
{
    
public function crearPreguntas(Request $request){

    if ( auth()->user()->Tipo == "Profesor") {
        $request->validate(
            [
               
                'id_Contenido'=> 'required',
                'problema'    => 'required',
                'respuesta'   => 'required',
                'opc1'        => 'required',
                'opc2'        => 'required',
                'opc3'        => 'required',
            ]
        );
        $problemas = new ejercicios();
        $problemas->id_Contenido=$request->id_Contenido;
        $problemas->problema    =$request->problema    ;
        $problemas->respuesta   =$request->respuesta   ;
        $problemas->opc1        =$request->opc1        ;
        $problemas->opc2        =$request->opc2        ;
        $problemas->opc3        =$request->opc3        ;

        $problemas->save();

    
        return response()->json(
            [
                "status" => true,
                "msg" =>"El ejercicio fue creado con exito!",
                "data"=>$problemas
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
 
public function verPreguntas(Request $request)
{
    $preguntas= ejercicios::where('id_Curso',$request->id_Curso) ->get();
   
}


}
