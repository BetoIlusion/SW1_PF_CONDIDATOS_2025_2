<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('empleador')) {
            return "empleador";
            return inertia('Empleador/Dashboard');
        } elseif ($user->hasRole('candidato')) {
            return "candidato";
            return inertia('Candidato/Dashboard');
        }
    

        return inertia('Principal');
    }
}
