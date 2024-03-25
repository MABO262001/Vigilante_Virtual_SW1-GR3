<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'es_correcta',
        'pregunta_id',
    ];

    protected $table = 'respuestas';

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
