<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;

    protected $table = "cursos";

    protected $fillable = [
        'id_Profesor',
        'Nom_Curso',
        'Descripcion',
        'Img_Curso',
        "cant_alumnos",
        'Color',
        
    ];
    

    public function estudiantes() {
        return $this->hasMany(estudiantes::class);
    }
    /*Tiene muchos estudiantes*/
    
    public function profesor() {
        return $this->belongsTo(profesor::class);
    }

    /*pertenece a un profesor*/
    
}

