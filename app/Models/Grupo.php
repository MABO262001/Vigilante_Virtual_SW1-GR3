<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';

    protected $fillable = [
        'nombre',
    ];

    public function grupo_materia()
    {
        return $this->belongsTomany(Materia::class, 'grupo_materias', 'grupo_id', 'materia_id')->withTimestamps();
    }

    public function grupo_materia_comprobante()
    {
        return $this->belongsToMany(GrupoMateriaComprobante::class, 'grupo_materia_comprobantes', 'comprobante_id', 'grupo_materia_id')->withTimestamps();
    }

}
