<?php
namespace Dlouvard\LaravelGestionmaintenance\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
class MaintenanceMiddleware
{
    public function handle($request, Closure $next)
    {
        $status = maintenance_status();
        if ($status && auth()->check()):
            if (!can('maintenance')):
                if ($status == 1) {
                    Auth::logout();
                }
            endif;
        endif;
        return $next($request);
    }
}