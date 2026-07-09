<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->status == 'active'){
            return $next($request);
        }elseif ($request->user()->status == 'verify'){
            return redirect('/verify');
        }

        return response()->json(['message' => 'Invalid status'], 400);
    }
}
