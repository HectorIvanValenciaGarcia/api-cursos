<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calificacion extends Model
{
    use HasFactory;

    protected $table ="calificaciones";
    protected $fillable =
    [
        'id_Curso',
        'id_Estudiante',
      
        'id_Leccion'    ,
        'calificaciones' 
    ];

    public function estudiante() {
        return $this->belongsTo(estudiantes::class);
    }
    public function leccion() {
        return $this->belongsTo(lecciones::class);
    }
    public function curso() {
        return $this->belongsTo(Cursos::class);
    }


}
