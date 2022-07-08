<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;

    protected $table = "cursos";

    protected $fillable = [
        'Nom_Curso',
        'Descripcion',
        'Img_Curso',
        'Color',
        
    ];
    public $timestamps = false;

    public function estudiantes() {
        return $this->hasMany(estudiantes::class);
    }
}
