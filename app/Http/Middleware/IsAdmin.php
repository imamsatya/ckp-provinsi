<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        // return $next($request);
                if(auth()->user()->jabatan_id == 3){

            return $next($request);

        }

   

        return redirect(‘home’)->with(‘error’,"You don't have admin access.");
    }
}
