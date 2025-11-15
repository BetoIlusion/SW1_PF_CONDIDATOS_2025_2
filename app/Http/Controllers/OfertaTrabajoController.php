<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfertaTrabajo;

class OfertaTrabajoController extends Controller
{
    public function show($id)
    {

        $oferta = OfertaTrabajo::with('user')->findOrFail($id);
        return inertia('Ofertas/show', [
            'oferta' => $oferta
        ]);
    }
}
