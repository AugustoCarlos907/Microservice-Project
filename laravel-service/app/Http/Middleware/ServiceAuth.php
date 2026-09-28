<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Autenticação simples entre microserviços via header + segredo compartilhado.
 * Em produção, considere trocar por JWT assimétrico ou OAuth2 client_credentials.
 */
class ServiceAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('X-Service-Token');

        if (! $token || $token !== config('services.internal.secret')) {
            return response()->json(['message' => 'Não autorizado.'], 401);
        }

        return $next($request);
    }
}