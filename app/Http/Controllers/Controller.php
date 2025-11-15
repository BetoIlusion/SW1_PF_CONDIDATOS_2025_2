<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Inertia;
use App\Models\OfertaTrabajo;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('empleador')) {
            return "dasboard empleador";
            return inertia('Empleador/Dashboard');
        } elseif ($user->hasRole('candidato')) {
            $ofertas = OfertaTrabajo::all();
            return inertia('DashboardCandidato', [
                'ofertas' => $ofertas
            ]);
        }


        return inertia('Principal');
    }
}
