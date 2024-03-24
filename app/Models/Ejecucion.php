<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ejecucion extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'hora_inicio',
        'hora_final',
        'ponderacion',
        'contrasena',
        'examen_id'
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }

    public function estadoEjecucion()
    {
        return $this->belongsTo(EstadoEjecucion::class);
    }

    public static function getExamenesEjecutandose($data){

        $today = Carbon::now()->format('Y-m-d');

        $query = DB::table('ejecucions');
        if(isset($data['min']) 
        && $data['min'] === 1){                
                $query->select(DB::raw('COUNT(ejecucions.id) as total'));
            }
        else{
            //Logica cuando se requiera datos mas informacion, por ahora no
        }

        $query->leftJoin('examens', 'examens.id', 'ejecucions.examen_id');

        if(isset($data['user_id'])
        && $data['user_id'] != ''){
            $query->where('examens.user_id', $data['user_id']);
        }

        return $query->get();
    }
}
