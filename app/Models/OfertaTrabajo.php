<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfertaTrabajo extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'descripcion',
        'modalidad',
        'tipo_contrato',
        'salario_minimo',
        'salario_maximo',
        'moneda',
        'ubicacion',
        'experiencia_min',
        'skills_requeridos',
        'fecha_publicacion',
        'fecha_cierre',
        'estado',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'skills_requeridos' => 'array',
        'fecha_publicacion' => 'datetime',
        'fecha_cierre' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
