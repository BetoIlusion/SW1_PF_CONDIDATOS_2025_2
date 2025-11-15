<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;
    protected $fillable = [
        'perfil_profesional',
        'experiencia_total',
        'skills',
        'experiencias',
        'certificaciones',
        'user_id',
    ];

    protected $casts = [
        'skills' => 'array',
        'experiencias' => 'array',
        'certificaciones' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
