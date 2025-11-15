<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvBase extends Model
{
    use HasFactory;
    protected $fillable = [
        'experiencia_total',
        'idiomas',
        'skills',
        'educacion',
        'pretension_salarial',
        'disponibilidad',
        'portafolio_url',
        'cv_path',
        'user_id',
    ];

    protected $casts = [
        'skills' => 'array',
        'educacion' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
