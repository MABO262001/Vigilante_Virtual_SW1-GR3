<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $fillable = [
        'tema',
        'descripcion',
        'fecha',
        'hora_inicio',
        'hora_final',
        'ponderacion',
        'contrasena',
        'id_docente',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
