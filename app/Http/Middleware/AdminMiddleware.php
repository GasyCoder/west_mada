<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if ($user->hasRole('admin') || ($user->hasRole('employe') && $user->is_active == 1)) {
            return $next($request);
        }

        // Si l'utilisateur est un employé inactif, redirigez-le vers la page de connexion.
        if ($user->hasRole('employe') && $user->is_active == 0) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Votre compte est désactivé.');
        }

        // Si l'utilisateur n'a pas les rôles appropriés, redirigez-le ailleurs.
        return redirect('/');
    }
}

