<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infoCursando extends Model
{
    use HasFactory;
    protected $table = "info_cursando";

    protected $fillable = [
        'id_Estudiante',
        'id_Cursos',
        'puntuacion',
        
    ];



public function estudiante() {
    return $this->belongsTo(estudiantes::class);
}
public function Cursos() {
    return $this->belongsTo(Cursos::class);
}

}
