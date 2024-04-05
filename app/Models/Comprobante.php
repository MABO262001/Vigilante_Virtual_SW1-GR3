<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    use HasFactory;

    protected $table = 'comprobantes';

    protected $fillable = [
        'user_estudiante_id',
        'user_administrativo_id',
        'hora',
        'fecha',
        'monto_total',
    ];

    public function user_estudiante()
    {
        return $this->belongsTo(User::class);
    }

    public function user_administrativo()
    {
        return $this->belongsTo(User::class);
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'servicio_comprobantes', 'comprobante_id', 'servicio_id')->withTimestamps();
    }

    public function grupo_materia_comprobante()
    {
        return $this->belongsToMany (GrupoMateriaComprobante::class, 'grupo_materia_comprobantes', 'comprobante_id', 'grupo_materia_id')->withTimestamps();
    }

}