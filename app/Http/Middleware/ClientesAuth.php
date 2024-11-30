<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientesAuth
{
    public function handle($request, Closure $next)
    {
        if (!auth()->guard('clientes')->check() && !auth()->guard('web')->check()) {
            return redirect('/sesiones/login');
        }

        return $next($request);
    }
}
