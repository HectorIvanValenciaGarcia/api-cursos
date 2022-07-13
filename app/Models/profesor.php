<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class profesor extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;


    protected $table = "profesor";

    protected $fillable= [
        'Tipo',
        'Nom_Profesor',
        'Nom_Usuario',
        'Dir_img',
        'email',
        'password',

    ];
    

    public function cursos() {
        return $this->hasMany(Cursos::class);
        /*tiene muchos cursos*/
    }

}
