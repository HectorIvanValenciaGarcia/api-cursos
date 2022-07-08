<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infoCursando extends Model
{
    use HasFactory;
    protected $table = "estudiantes";

    protected $fillable = [
        'id_estudiante',
        'id_curso',
        'puntuacion',
        
    ];

public $timestamps = false;

public function estudiante() {
    return $this->belongsTo(estudiantes::class);
}
public function Cursos() {
    return $this->belongsTo(Cursos::class);
}

}
