<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoMateriaComprobante extends Model
{
    use HasFactory;

    protected $table = 'grupo_materia_comprobantes';

    protected $fillable = [
        'comprobante_id',
        'grupo_materia_id',
    ];

    public function comprobante()
    {
        return $this->belongsTo(Comprobante::class);
    }

    public function grupo_materia()
    {
        return $this->belongsTo(GrupoMateria::class);
    }
}
