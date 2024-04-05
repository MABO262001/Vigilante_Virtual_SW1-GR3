<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoMateria extends Model
{
    use HasFactory;

    protected $table = 'grupo_materias';

    protected $fillable = [
        'id',
        'grupo_id',
        'materia_id',
        'contraseña',
        'cantidad_estudiante',
        'cantidad_estudiantes_inscritos',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }

    public function ingreso()
    {
        return $this->belongsToMany(User::class, 'ingresos', 'grupo_materia_id', 'estudiante_id')->withTimestamps();
    }

}
