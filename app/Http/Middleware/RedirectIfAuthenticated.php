<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard('guru')->check()) {

            return redirect('/halaman/guru');
        } else if (Auth::guard('user')->check()) {

            return redirect('/dashboard');
        } else if (Auth::guard('siswa')->check()) {

            return redirect('/halaman/siswa');
        }

        return $next($request);
    }
}
