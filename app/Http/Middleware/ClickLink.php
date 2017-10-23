<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ClickLink
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Input::get('nextStep'))
        {
            return $next($request);

        }
        return redirect('checkoutStep3'.'/'. Auth::id());

    }
}
