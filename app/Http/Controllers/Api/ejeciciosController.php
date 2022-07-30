<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ejercicios;
use App\Models\calificacion;
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
    $request->validate(
        [
           
            'id_Contenido'=> 'required']);
    $preguntas= ejercicios::where('id_Contenido',$request->id_Contenido)->get();
    return response()->json(
        [
            "status" => true,
            "msg" =>"aqui esta el problema",
            "data"=> $preguntas
        ]
    );
}


public function validarRespuesta(Request $request){
    $request->validate(
        [
            'num_pregunta'=>'required',
            'id_Contenido'=>'required',
            'id_Leccion'=>'required',
            'id_Ejercicio'=>'required',
            'respuesta'=>'required',
        ]);

        $preguntas= ejercicios::where('id',$request->id_Ejercicio)->get();
        

        if($preguntas[0]["respuesta"]==$request->respuesta)
        {
            $calificacion=calificacion::where('id_Estudiante',auth()->user()->id)
                ->where('id_Leccion',$request->id_Leccion)
                ->get();
               
         
            if($calificacion->isEmpty()){
            $calificacion= new calificacion();
            $calificacion->id_Estudiante = auth()->user()->id;
           
            $calificacion->id_Leccion = $request->id_Leccion;
            $calificacion->calificaciones= (1.00/5.00)*100;
            $calificacion-> save();
            return response()->json(
                [
                    "status" => true,
                    "data" =>$preguntas[0]["respuesta"],
                    "msg"=> "la respuesta es correcta"
                ]
            );
          
              }else{
                $calificacion=calificacion::where('id_Estudiante',auth()->user()->id)
                ->where('id_Leccion',$request->id_Leccion)
                ->first();
$calificacion->calificaciones=($request->num_pregunta/5)*100;
$calificacion->update();
                return response()->json(
                    [
                        "status" => true,
                        "msg" =>"se actualizo el progreso",
                        "data"=> $preguntas[0]["respuesta"]
                    ]
                );
              
                
              }
    
        }else{
            return response()->json(
                [
                    "status" => $preguntas,
                    "msg" =>"no es correcto",
                    "data"=> "xd"
                ]
            );
        }
      

}

}
