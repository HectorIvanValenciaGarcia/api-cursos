<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contenidoLecciones extends Model
{
    use HasFactory;
    protected $table ="contenido_leccion";

    protected $fillable = [
        'id_Leccion',
        'contenido',
        'img'

    ];

    public function leccion() {
        return $this->belongsTo(lecciones::class);
     }

}
