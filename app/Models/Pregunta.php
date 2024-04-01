<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    protected $table = 'preguntas';

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

    public static function getAllRespuestas($id){
        $query = DB::table('preguntas')
        ->select('respuestas.*')
        ->leftJoin('respuestas', 'respuestas.pregunta_id','=','preguntas.id')
        ->where('preguntas.id', $id);
        return $query->get();
    }
}
