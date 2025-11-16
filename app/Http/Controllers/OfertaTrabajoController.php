<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfertaTrabajo;
use App\Models\User;

class OfertaTrabajoController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $ofertas = OfertaTrabajo::with('user')
            ->where('user_id', $user->id)
            ->get();

        return inertia('Ofertas/Index', [
            'ofertas' => $ofertas
        ]);
    }
    public function show($id)
    {

        $oferta = OfertaTrabajo::with('user')->findOrFail($id);
        return inertia('Ofertas/show', [
            'oferta' => $oferta
        ]);
    }
    public function store(Request $request) {
        $user = auth()->user();

        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'modalidad' => 'required|string',
            'tipo_contrato' => 'required|string',
            'salario_minimo' => 'nullable|numeric',
            'salario_maximo' => 'nullable|numeric',
            'moneda' => 'nullable|string|max:10',
            'ubicacion' => 'required|string|max:255',
            'experiencia_min' => 'nullable|integer',
            'skills_requeridos' => 'nullable|array',
            'fecha_publicacion' => 'required|date',
            'fecha_cierre' => 'required|date|after_or_equal:fecha_publicacion',
            'estado' => 'required|string|max:50',
            'is_active' => 'required|boolean',
        ]);

        $validatedData['user_id'] = $user->id;

        OfertaTrabajo::create($validatedData);

        return redirect()->route('ofertas.index')->with('success', 'Oferta de trabajo creada exitosamente.');
    }
}
