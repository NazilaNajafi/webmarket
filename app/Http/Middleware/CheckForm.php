<?php

namespace App\Http\Middleware;

use App\Buyer;
use Closure;

class CheckForm
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
        if(Buyer::where('user_id', $request->id)->first())
        {
            return $next($request);

        }
        return redirect('checkoutStep2');

    }
}
