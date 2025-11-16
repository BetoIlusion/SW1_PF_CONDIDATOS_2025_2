<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OfertaTrabajo;
use App\Models\User;

class Empleador extends Model
{
    use HasFactory;

    protected $table = 'empleadores';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'rubro',
        'usuario_id',
    ];

    public $timestamps = true;

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function ofertasTrabajo()
    {
        return $this->hasMany(OfertaTrabajo::class);
    }
}
