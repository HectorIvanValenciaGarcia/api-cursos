<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lecciones extends Model
{
    use HasFactory;
    protected $table = "lecciones";

 protected $fillable = [
    'id_Curso',
    'nombre',
    'descripcion',

 ];

 public function curso() {
   return $this->belongsTo(Cursos::class);
}




}
