<?php

namespace App\Http\Middleware;

use App\Models\RegistrationPeriod;
use Carbon\Carbon;
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

        $now = Carbon::now();

        if (!$period) {
            return redirect()->route('register.belum-dibuka');
        }

        if ($now->lt($period->start_at)) {
            return redirect()->route('register.belum-dibuka');
        }

        if ($now->gt($period->end_at)) {
            return redirect()->route('register.ditutup');
        }

        return $next($request);
    }
}
