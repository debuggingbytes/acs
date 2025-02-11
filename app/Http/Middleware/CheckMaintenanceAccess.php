<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->isDownForMaintenance()) {
            $maintenanceSecret = Session::get('maintenance_secret');

            // If no maintenance file exists, continue
            if (! file_exists(storage_path('framework/down'))) {
                return $next($request);
            }

            $maintenanceData = json_decode(file_get_contents(storage_path('framework/down')), true);

            // Check if secret in session matches maintenance secret
            if ($maintenanceSecret && isset($maintenanceData['secret']) && $maintenanceSecret === $maintenanceData['secret']) {
                return $next($request);
            }

            // Check if this is the bypass URL
            if ($request->is('maintenance/bypass/*')) {
                $urlSecret = $request->route('secret');
                if ($urlSecret && isset($maintenanceData['secret']) && $urlSecret === $maintenanceData['secret']) {
                    Session::put('maintenance_secret', $urlSecret);
                    return $next($request);
                }
            }

            // If no valid secret, show default maintenance page
            return $next($request);
        }

        return $next($request);
    }
}
