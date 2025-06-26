<?php

namespace App\Http\Middleware;

use App\Models\RegistrationPeriod;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistrationPeriod
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $period = RegistrationPeriod::where('is_active', true)->latest('start_at')->first();

        $now = now('Asia/Jakarta');

        if (!$period || $now->lt($period->start_at)) {
            return redirect()->route('register.belum-dibuka');
        }

        if ($now->gt($period->end_at)) {
            return redirect()->route('register.ditutup');
        }

        return $next($request);
    }
}
