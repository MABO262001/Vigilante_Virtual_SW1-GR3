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
        'docente_id',
        'estado_examen_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ejecuciones()
    {
        return $this->hasMany(Ejecucion::class);
    }

    public function estado_examen()
    {
        return $this->belongsTo(EstadoEjecucion::class);
    }

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

}
