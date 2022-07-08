<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class estudiantes extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     *Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */

protected $table = "estudiantes";

    protected $fillable = [
        'Nom_Estudiante',
        'Nom_Usuario',
        'Dir_img',
        'email',
        'password',
    ];

public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     *//* 
    protected $hidden = [
        'password',
        'remember_token',
    ];
 */
    /**
    *Los atributos que se deben emitir.
     *
     * @var array<string, string>
     */
  /*   protected $casts = [
        'email_verified_at' => 'datetime',
    ]; */
    public function Cursos() {
        return $this->hasMany(Cursos::class);
    }

}
