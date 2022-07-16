<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ejercicios extends Model
{
    use HasFactory;

    protected $table = "ejercicios";
    protected $fillable = [
        'id_Contenido',
        'problema'    ,
        'respuesta'    ,
        'opc1'         ,
        'opc2'         ,
        'opc3'         

    ];

    public function contenido() {
        return $this->belongsTo(contenidoLecciones::class);
    }

}
