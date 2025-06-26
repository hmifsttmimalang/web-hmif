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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $period = RegistrationPeriod::where('is_active', true)->latest('start_at')->first();

        if (!$period || now()->lt($period->start_at) || now()->gt($period->end_at)) {
            return redirect()->route('login')->withErrors(['closed' => 'Pendaftaran belum dibuka atau ditutup']);
        }

        return $next($request);
    }
}
