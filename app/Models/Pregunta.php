<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'ponderacion',
        'comentario',
        'tipo_pregunta_id',
        'examen_id',
    ];

    public function tipoPregunta()
    {
        return $this->belongsTo(TipoPregunta::class);
    }

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
